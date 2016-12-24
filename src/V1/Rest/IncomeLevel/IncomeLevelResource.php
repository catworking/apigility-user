<?php
namespace ApigilityUser\V1\Rest\IncomeLevel;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class IncomeLevelResource extends ApigilityResource
{
    /**
     * @var \ApigilityUser\Service\IncomeLevelService
     */
    protected $incomeLevelService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->incomeLevelService = $this->serviceManager->get('ApigilityUser\Service\IncomeLevelService');
    }

    public function create($data)
    {
        try {
            return new IncomeLevelEntity($this->incomeLevelService->createIncomeLevel($data));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetch($id)
    {
        try {
            return new IncomeLevelEntity($this->incomeLevelService->getIncomeLevel($id));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetchAll($params = [])
    {
        try {
            return new IncomeLevelCollection($this->incomeLevelService->getIncomeLevels($params));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function patch($id, $data)
    {
        try {
            return new IncomeLevelEntity($this->incomeLevelService->updateIncomeLevel($id, $data));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->incomeLevelService->deleteIncomeLevel($id);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
