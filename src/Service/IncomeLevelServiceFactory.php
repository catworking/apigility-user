<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/28
 * Time: 15:11
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;

class IncomeLevelServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new IncomeLevelService($services);
    }
}