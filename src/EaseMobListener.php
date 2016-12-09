<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/9
 * Time: 11:02
 */
namespace ApigilityUser;

use ApigilityUser\Service\IdentityService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;
use ApigilityUser\DoctrineEntity\User;

class EaseMobListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    private $services;

    /**
     * @var \ApigilityUser\Service\EaseMobService
     */
    private $easeMobService;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(IdentityService::EVENT_IDENTITY_CREATED, [$this, 'createAccount'], $priority);
    }

    public function createAccount(EventInterface $e)
    {
        $params = $e->getParams();

        $this->getEaseMobService()->createAccount($params['user_id'], $params['password'], '用户'.$params['user_id']);
    }

    /**
     * @return \ApigilityUser\Service\EaseMobService
     */
    private function getEaseMobService()
    {
        if (empty($this->easeMobService)) $this->easeMobService = $this->services->get('ApigilityUser\Service\EaseMobService');

        return $this->easeMobService;
    }
}