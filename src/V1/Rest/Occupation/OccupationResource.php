<?php
namespace ApigilityUser\V1\Rest\Occupation;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class OccupationResource extends ApigilityResource
{
    /**
     * @var \ApigilityUser\Service\OccupationService
     */
    protected $occupationService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->occupationService = $this->serviceManager->get('ApigilityUser\Service\OccupationService');
    }

    public function create($data)
    {
        try {
            return new OccupationEntity($this->occupationService->createOccupation($data));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetch($id)
    {
        try {
            return new OccupationEntity($this->occupationService->getOccupation($id));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetchAll($params = [])
    {
        try {
            return new OccupationCollection($this->occupationService->getOccupations($params));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function patch($id, $data)
    {
        try {
            return new OccupationEntity($this->occupationService->updateOccupation($id, $data));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->occupationService->deleteOccupation($id);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
