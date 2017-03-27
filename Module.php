<?php
namespace ApigilityUser;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Config\Config;

class Module implements ApigilityProviderInterface
{
    protected $sm;

    public function getConfig()
    {
        $doctrine_config = new Config(include __DIR__ . '/config/doctrine.config.php');
        $service_config = new Config(include __DIR__ . '/config/service.config.php');
        $manual_config = new Config(include __DIR__ . '/config/manual.config.php');

        $module_config = new Config(include __DIR__ . '/config/module.config.php');
        $module_config->merge($doctrine_config);
        $module_config->merge($service_config);
        $module_config->merge($manual_config);

        return $module_config;
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

    public function onBootstrap(MvcEvent $e)
    {
        // This method is called once the MVC bootstrapping is complete
        $application = $e->getApplication();
        $services    = $application->getServiceManager();

        $events = $services->get('ApigilityUser\Service\IdentityService')->getEventManager();
        $personalCertificationServiceEvents = $services->get('ApigilityUser\Service\PersonalCertificationService')->getEventManager();

        // 创建用户对象
        $user_listener = new UserListener($services);
        $user_listener->attach($events);
        $user_listener->attachToPersonalCertificationService($personalCertificationServiceEvents);
    }
}
