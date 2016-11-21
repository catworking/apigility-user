<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/21
 * Time: 17:25
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;

class UserService
{
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 获取单个用户
     *
     * @param $user_id
     */
    public function getUser($user_id)
    {
        $user = $this->em->find('ApigilityUser\DoctrineEntity\User', $user_id);
        if (empty($user)) {
            // TODO: throw exception
        }

        return $user;
    }
}