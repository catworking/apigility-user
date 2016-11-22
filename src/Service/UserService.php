<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 13:46
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserService
{
    protected $em;
    protected $classMethodsHydrator;

    public function __construct(ServiceManager $services)
    {
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->classMethodsHydrator = new ClassMethodsHydrator();
    }

    /**
     * 获取单个用户信息
     *
     * @param $user_id
     * @return mixed
     * @throws Exception\UserNotExistException
     */
    public function getUser($user_id)
    {
        $user = $this->em->find('ApigilityUser\DoctrineEntity\User', $user_id);
        if (empty($user)) throw new Exception\UserNotExistException();

        return $user;
    }

    /**
     * 更新单个用户信息
     *
     * @param $user_id
     * @param $data
     * @return mixed
     */
    public function updateUser($user_id, $data)
    {
        $user = $this->getUser($user_id);
        $this->classMethodsHydrator->hydrate($data, $user);

        $this->em->flush();

        return $user;
    }
}