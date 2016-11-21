<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/21
 * Time: 15:58
 */
namespace ApigilityUser;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;
use ApigilityUser\DoctrineEntity\User;

class UserListener implements ListenerAggregateInterface
{
    const EVENT_IDENTITY_CREATED = 'UserListener.EventIdentityCreated';

    use ListenerAggregateTrait;

    private $services;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(self::EVENT_IDENTITY_CREATED, [$this, 'createUser'], $priority);
    }

    public function createUser(EventInterface $e)
    {
        $params = $e->getParams();

        // 创建用户记录
        $entity_manager = $this->services->get('Doctrine\ORM\EntityManager');

        $user = new User();
        $user->setId($params['user_id']);

        $entity_manager->persist($user);
        $entity_manager->flush();
    }
}