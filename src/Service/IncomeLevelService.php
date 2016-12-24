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

class IncomeLevelService
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
     * 创建一个收入等级
     *
     * @param $data
     * @return DoctrineEntity\IncomeLevel
     */
    public function createIncomeLevel($data)
    {
        $income_level = new DoctrineEntity\IncomeLevel();

        if (isset($data->max_income)) $income_level->setMaxIncome($data->max_income);
        if (isset($data->min_income)) $income_level->setMinIncome($data->min_income);

        $this->em->persist($income_level);
        $this->em->flush();

        return $income_level;
    }

    /**
     * 获取一个收入等级
     *
     * @param $income_level_id
     * @return \ApigilityUser\DoctrineEntity\IncomeLevel
     * @throws \Exception
     */
    public function getIncomeLevel($income_level_id)
    {
        $income_level = $this->em->find('ApigilityUser\DoctrineEntity\IncomeLevel', $income_level_id);
        if (empty($income_level)) throw new \Exception('找不到该收入等级', 404);

        return $income_level;
    }

    /**
     * 获取一个收入等级列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     */
    public function getIncomeLevels($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('il')->from('ApigilityUser\DoctrineEntity\IncomeLevel', 'il');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 修改收入等级
     *
     * @param $income_level_id
     * @param $data
     * @return DoctrineEntity\IncomeLevel
     * @throws \Exception
     */
    public function updateIncomeLevel($income_level_id, $data)
    {
        $income_level = $this->getIncomeLevel($income_level_id);

        if (isset($data->max_income)) $income_level->setMaxIncome($data->max_income);
        if (isset($data->min_income)) $income_level->setMinIncome($data->min_income);

        $this->em->flush();

        return $income_level;
    }

    /**
     * 删除一个收入等级
     *
     * @param $income_level_id
     * @return bool
     * @throws \Exception
     */
    public function deleteIncomeLevel($income_level_id)
    {
        $income_level = $this->getIncomeLevel($income_level_id);

        $this->em->remove($income_level);
        $this->em->flush();

        return true;
    }
}