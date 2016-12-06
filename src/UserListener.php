<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/21
 * Time: 15:58
 */
namespace ApigilityUser;

use ApigilityUser\Service\IdentityService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;
use ApigilityUser\DoctrineEntity\User;

class UserListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    private $services;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(IdentityService::EVENT_IDENTITY_CREATED, [$this, 'createUser'], $priority);
    }

    public function createUser(EventInterface $e)
    {
        $params = $e->getParams();

        // 创建用户记录
        $userService = $this->services->get('ApigilityUser\Service\UserService');
        $userService->createUser(json_decode('{"user_id":"'. $params['user_id'] .'"}'));
    }
}