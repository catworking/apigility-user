<?php
namespace ApigilityUser\V1\Rest\Identity;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class IdentityResource extends ApigilityResource
{
    protected $identityService;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->identityService = $services->get('ApigilityUser\Service\IdentityService');
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 创建一个用户标识
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try {
            $identity = $this->identityService->createIdentity($data);
            $identity_entity = new IdentityEntity($identity);

            return $identity_entity;
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(),$exception);
        }
    }

    /**
     * 查找用户标识
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $dql = "SELECT i FROM ApigilityUser\\DoctrineEntity\\Identity i WHERE i.phone=?1";
        $query = $this->em->createQuery($dql)
            ->setParameter(1, $params->phone)
            ->setFirstResult(0)
            ->setMaxResults(100);

        $doctrine_paginator = new DoctrineToolPaginator($query);

        $c = new IdentityCollection(new DoctrinePaginatorAdapter($doctrine_paginator));

        if ($c->count() == 1) {
            // 每次登录时者尝试创建环信帐号，防止注册时注册失败，后面将无法再创建
            $config = $this->serviceManager->get('config');
            if ($config['apigility-user']['ease-mob']['enable']) {
                $identity = $c->getItem(0);
                $this->serviceManager->get('ApigilityUser\Service\EaseMobService')->createAccount($identity->getId(), '用户'.$identity->getId());
            }
        }

        return $c;
    }

    /**
     * 更新手机号码或密码
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        try {
            $identity = null;
            if (!empty($data->phone) && !empty($data->password)) {
                $identity =  $this->identityService->updateIdentity($id, $data->phone, $data->password);
            } else if (!empty($data->phone)) {
                $identity =  $this->identityService->updateIdentity($id, $data->phone);
            } else if (!empty($data->password)) {
                $identity =  $this->identityService->updateIdentity($id, null, $data->password);
            } else {

            }

            return new IdentityEntity($identity);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(),$exception);
        }
    }
}
