<?php
namespace ApigilityUser\V1\Rest\Identity;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class IdentityResource extends AbstractResourceListener
{
    protected $identityService;
    protected $services;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
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
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * 查找用户标识
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $dql = "SELECT i FROM ApigilityUser\\DoctrineEntity\\Identity i WHERE i.phone=?1";
        $query = $this->em->createQuery($dql)
            ->setParameter(1, $params->phone)
            ->setFirstResult(0)
            ->setMaxResults(100);

        $doctrine_paginator = new DoctrineToolPaginator($query);

        $c = new IdentityCollection(new DoctrinePaginatorAdapter($doctrine_paginator));
        //var_dump($c); exit();
        return $c;
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

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
