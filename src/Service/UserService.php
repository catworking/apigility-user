<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 13:46
 */
namespace ApigilityUser\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class UserService
{
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    public function getUser($user_id)
    {
        $user = $this->em->find('ApigilityUser\DoctrineEntity\User', $user_id);
        if (empty($user)) throw new Exception\UserNotExistException();

        return $user;
    }
}