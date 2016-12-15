<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/9
 * Time: 11:02
 */
namespace ApigilityUser;

use ApigilityUser\Service\IdentityService;
use ApigilityUser\Service\UserService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;
use ApigilityUser\DoctrineEntity\User;

class EaseMobListener
{
    protected $listeners = [];

    private $services;

    /**
     * @var \ApigilityUser\Service\EaseMobService
     */
    private $easeMobService;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attachToIdentityService(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(IdentityService::EVENT_IDENTITY_CREATED, [$this, 'createAccount'], $priority);
    }

    public function attachToUserService(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(UserService::EVENT_USER_NICKNAME_UPDATE, [$this, 'updateAccountNickname'], $priority);

    }

    public function createAccount(EventInterface $e)
    {
        $params = $e->getParams();

        try {
            return $this->getEaseMobService()->createAccount($params['user_id'], '用户'.$params['user_id']);
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function updateAccountNickname(EventInterface $e)
    {
        $params = $e->getParams();

        try {
            return $this->getEaseMobService()->updateNickname($params['user']->getId(), $params['user']->getNickname());
        } catch (\Exception $exception) {
            return false;
        }
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