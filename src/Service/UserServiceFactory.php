<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 13:47
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;

class UserServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new UserService($services);
    }
}