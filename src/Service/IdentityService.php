<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/16
 * Time: 14:49
 */
namespace ApigilityUser\Service;

use ApigilityCatworkFoundation\Base\ApigilityEventAwareObject;
use Doctrine\ORM\QueryBuilder;
use Zend\ServiceManager\ServiceManager;
use ApigilityUser\DoctrineEntity\Identity;
use ApigilityUser\UserListener;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class IdentityService extends ApigilityEventAwareObject
{
    const EVENT_IDENTITY_CREATED = 'IdentityService.EventIdentityCreated';
    const EVENT_GETTING_IDENTITIES = 'IdentityService.EVENT_GETTING_IDENTITIES';

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityOauth2Adapter\OauthUserManager
     */
    protected $oauthUserManager;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function __construct(ServiceManager $services)
    {
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->oauthUserManager = $services->get('ApigilityOauth2Adapter\OauthUserManager');
        $this->serviceManager = $services;
    }

    /**
     * @param $id
     * @return \ApigilityUser\DoctrineEntity\Identity
     * @throws Exception\UserNotExistException
     */
    public function getIdentity($id)
    {
        $identity = $this->em->find('ApigilityUser\DoctrineEntity\Identity', $id);
        if (empty($identity)) throw new Exception\UserNotExistException();

        return $identity;
    }

    /**
     * 检查用户标识是否存在
     *
     * @param $condition
     * @return boolean
     */
    public function identityExist($condition)
    {
        $identities = $this->em->getRepository('ApigilityUser\DoctrineEntity\Identity')->findBy($condition);
        if (count($identities)) return true;
        else return false;
    }

    /**
     * 创建用户标识
     * @param $data
     * @return Identity
     * @throws Exception\PhoneExistException
     * @internal param $phone
     * @internal param $password
     */
    public function createIdentity($data)
    {
        // 检查手机号是否已经注册
        if (isset($data->phone)) {
            $condition = ['phone'=>$data->phone];
            if (isset($data->type)) $condition['type'] = $data->type;

            if ($this->identityExist($condition)) throw new Exception\PhoneExistException();
        }

        // 创建认证用户
        $oauth_user = $this->oauthUserManager->createUser($data->password);

        $identity = new Identity();
        $identity->setId($oauth_user->getUsername());
        if (isset($data->phone)) $identity->setPhone($data->phone);
        if (isset($data->type)) $identity->setType($data->type);

        $this->em->persist($identity);
        $this->em->flush();

        // 触发标识已创建事件
        $this->getEventManager()->trigger(self::EVENT_IDENTITY_CREATED, $this, [
            'user_id' => $identity->getId(),
            'password'=>$data->password
        ]);

        return $identity;
    }

    /**
     * 更新一个标识的手机号码或密码
     *
     * @param $id
     * @param null $phone
     * @param null $password
     * @return \ApigilityUser\DoctrineEntity\Identity
     * @throws Exception\IdentityNotExistException
     */
    public function updateIdentity($id, $phone = null, $password = null)
    {
        $identity = $this->em->find('ApigilityUser\DoctrineEntity\Identity', $id);
        if (empty($identity)) throw new Exception\IdentityNotExistException();

        if (!empty($phone)) {
            $identity->setPhone($phone);
            $this->em->flush();
        }

        if (!empty($password)) {
            $this->oauthUserManager->updatePassword($id, $password);
        }

        return $identity;
    }

    public function getIdentities($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('i')->from('ApigilityUser\DoctrineEntity\Identity', 'i');

        $where = '';

        if (isset($params->phone)) {
            if (!empty($where)) $where .= ' AND ';
            $where .= 'i.phone = :phone';
        }

        if (isset($params->type)) {
            if (!empty($where)) $where .= ' AND ';
            $where .= 'i.type = :type';
        }

        if (!empty($where)) {
            $qb->where($where);

            if (isset($params->phone)) $qb->setParameter('phone', $params->phone);
            if (isset($params->type)) $qb->setParameter('type', $params->type);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        $doctrine_paginator_adapter = new DoctrinePaginatorAdapter($doctrine_paginator);

        // 触发查找标识列表事件
        $this->getEventManager()->trigger(self::EVENT_GETTING_IDENTITIES, $this, [
            'doctrine_paginator_adapter' => $doctrine_paginator_adapter
        ]);

        return $doctrine_paginator_adapter;
    }
}