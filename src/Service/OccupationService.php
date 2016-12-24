<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/28
 * Time: 15:11
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityUser\DoctrineEntity;

class OccupationService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 创建一个职业
     *
     * @param $data
     * @return DoctrineEntity\Occupation
     */
    public function createOccupation($data)
    {
        $occupation = new DoctrineEntity\Occupation();

        if (isset($data->name)) $occupation->setName($data->name);

        $this->em->persist($occupation);
        $this->em->flush();

        return $occupation;
    }

    /**
     * 获取一个职业对象
     *
     * @param $occupation_id
     * @return \ApigilityUser\DoctrineEntity\Occupation
     * @throws \Exception
     */
    public function getOccupation($occupation_id)
    {
        $occupation = $this->em->find('ApigilityUser\DoctrineEntity\Occupation', $occupation_id);
        if (empty($occupation)) throw new \Exception('找不到该职业', 404);

        return $occupation;
    }

    /**
     * 获取一个职业对象列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     */
    public function getOccupations($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('o')->from('ApigilityUser\DoctrineEntity\Occupation', 'o');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }


    /**
     * 修改职业
     *
     * @param $occupation_id
     * @param $data
     * @return DoctrineEntity\Occupation
     * @throws \Exception
     */
    public function updateOccupation($occupation_id, $data)
    {
        $occupation = $this->getOccupation($occupation_id);

        if (isset($data->name)) $occupation->setName($data->name);

        $this->em->flush();

        return $occupation;
    }

    /**
     * 删除一个职业
     *
     * @param $occupation_id
     * @return bool
     * @throws \Exception
     */
    public function deleteOccupation($occupation_id)
    {
        $occupation = $this->getOccupation($occupation_id);

        $this->em->remove($occupation);
        $this->em->flush();

        return true;
    }
}