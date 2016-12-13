<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/13
 * Time: 16:24
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;

class ProfessionalCertificationServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new ProfessionalCertificationService($services);
    }
}