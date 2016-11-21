<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/16
 * Time: 14:49
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;
use ApigilityUser\DoctrineEntity\Identity;
use ApigilityUser\UserListener;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;

class IdentityService implements EventManagerAwareInterface
{
    protected $events;

    protected $em;
    protected $oauthUserManager;
    protected $eventManager;

    public function __construct(ServiceManager $services)
    {
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->oauthUserManager = $services->get('ApigilityOauth2Adapter\OauthUserManager');
        $this->eventManager = $services->get('EventManager');
    }

    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers([
            __CLASS__,
            get_called_class(),
        ]);
        $this->events = $events;
        return $this;
    }

    public function getEventManager()
    {
        if (null === $this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }

    /**
     * 检查用户标识是否存在
     *
     * @param $condition
     * @return boolean
     */
    public function identityExist($condition)
    {
        $dql = "SELECT i FROM ApigilityUser\\DoctrineEntity\\Identity i WHERE i.phone=?1";
        $rs = $this->em->createQuery($dql)
            ->setParameter(1, $condition['phone'])
            ->getResult();

        if (count($rs)) return true;
        else return false;
    }

    /**
     * 创建用户标识
     * @param $phone
     * @param $password
     * @return Identity
     * @throws \Exception
     */
    public function createIdentity($phone, $password)
    {
        if (!$this->identityExist(array(
            'phone'=>$phone // 检查手机号是否已经注册
        ))) {
            // 创建认证用户
            $oauth_user = $this->oauthUserManager->createUser($password);

            $identity = new Identity();
            $identity->setId($oauth_user->getUsername());
            $identity->setPhone($phone);

            $this->em->persist($identity);
            $this->em->flush();

            // 触发标识已创建事件
            $this->getEventManager()->trigger(UserListener::EVENT_IDENTITY_CREATED, $this, ['user_id' => $identity->getId()]);

            return $identity;
        } else {
            throw new Exception\PhoneExistException();
        }
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
}