<?php
namespace ApigilityUser\V1\Rest\ProfessionalCertification;

use Zend\ServiceManager\ServiceManager;
use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;

class ProfessionalCertificationResource extends ApigilityResource
{
    /**
     * @var \ApigilityUser\Service\ProfessionalCertificationService
     */
    protected $professionalCertificationService;

    /**
     * @var \ApigilityUser\Service\UserService
     */
    protected $userService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->professionalCertificationService = $this->serviceManager->get('ApigilityUser\Service\ProfessionalCertificationService');
        $this->userService = $this->serviceManager->get('ApigilityUser\Service\UserService');
    }

    public function create($data)
    {
        try {
            $auth_user = $this->userService->getAuthUser();
            return new ProfessionalCertificationEntity($this->professionalCertificationService->createProfessionalCertification($data, $auth_user), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function patch($id, $data)
    {
        try {
            return new ProfessionalCertificationEntity($this->professionalCertificationService->updateProfessionalCertification($id, $data), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
