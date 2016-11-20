<?php
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;

class IdentityServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new IdentityService($services);
    }
}
