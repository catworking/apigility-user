<?php
namespace ApigilityUser\V1\Rest\PersonalCertification;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class PersonalCertificationResource extends ApigilityResource
{
    /**
     * @var \ApigilityUser\Service\PersonalCertificationService
     */
    protected $personalCertificationService;

    /**
     * @var \ApigilityUser\Service\UserService
     */
    protected $userService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->personalCertificationService = $this->serviceManager->get('ApigilityUser\Service\PersonalCertificationService');
        $this->userService = $this->serviceManager->get('ApigilityUser\Service\UserService');
    }

    public function create($data)
    {
        try {
            $auth_user = $this->userService->getAuthUser();
            return new PersonalCertificationEntity($this->personalCertificationService->createPersonalCertification($data, $auth_user), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
