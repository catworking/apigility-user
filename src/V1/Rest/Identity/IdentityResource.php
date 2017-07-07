<?php
namespace ApigilityUser\V1\Rest\Identity;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class IdentityResource extends ApigilityResource
{
    /**
     * @var \ApigilityUser\Service\IdentityService
     */
    protected $identityService;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->identityService = $services->get('ApigilityUser\Service\IdentityService');
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 创建一个用户标识
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try {
            $identity = $this->identityService->createIdentity($data);
            $identity_entity = new IdentityEntity($identity);

            return $identity_entity;
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(),$exception);
        }
    }

    /**
     * 查找用户标识
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        try {
            return new IdentityCollection($this->identityService->getIdentities($params));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * 更新手机号码或密码
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        try {
            $identity = null;
            if (!empty($data->phone) && !empty($data->password)) {
                $identity =  $this->identityService->updateIdentity($id, $data->phone, $data->password);
            } else if (!empty($data->phone)) {
                $identity =  $this->identityService->updateIdentity($id, $data->phone);
            } else if (!empty($data->password)) {
                $identity =  $this->identityService->updateIdentity($id, null, $data->password);
            } else {

            }

            return new IdentityEntity($identity);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(),$exception);
        }
    }
}
