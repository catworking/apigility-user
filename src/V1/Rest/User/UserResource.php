<?php
namespace ApigilityUser\V1\Rest\User;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ObjectProperty as ObjectPropertyHydrator;

class UserResource extends ApigilityResource
{
    protected $services;
    protected $userService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->services = $services;
        $this->userService = $services->get('ApigilityUser\Service\UserService');
    }

    /**
     * 获取单个用户信息
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        try {
            return new UserEntity($this->userService->getUser($id), $this->services);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception);
        }
    }

    /**
     * 修改单个用户信息
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        try {
            return new UserEntity($this->userService->updateUser($id, $data), $this->services);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception);
        }
    }
}
