<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/13
 * Time: 16:24
 */
namespace ApigilityUser\Service;

use ApigilityUser\DoctrineEntity\User;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityUser\DoctrineEntity;

class ProfessionalCertificationService
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

    public function createProfessionalCertification($data, User $user)
    {
        $professionalCertification = new DoctrineEntity\ProfessionalCertification();
        $professionalCertification->setStatus($professionalCertification::STATUS_NOT_REVIEW);
        if (isset($data->identity_card_number)) $professionalCertification->setIdentityCardNumber($data->identity_card_number);
        if (isset($data->certification_image_front)) $professionalCertification->setCertificationImageFront($data->certification_image_front);
        if (isset($data->certification_image_back)) $professionalCertification->setCertificationImageBack($data->certification_image_back);
        $professionalCertification->setUser($user);

        $this->em->persist($professionalCertification);
        $this->em->flush();

        return $professionalCertification;
    }

    public function getProfessionalCertification($professional_certification_id)
    {
        $professionalCertification = $this->em->find('ApigilityUser\DoctrineEntity\ProfessionalCertification', $professional_certification_id);
        if (empty($professionalCertification)) throw new \Exception('实名认证信息不存在', 404);
        else return $professionalCertification;
    }

    public function getProfessionalCertifications($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('pc')->from('ApigilityUser\DoctrineEntity\ProfessionalCertification', 'pc');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    public function updateProfessionalCertification($professional_certification_id, $data)
    {
        $professionalCertification = $this->getProfessionalCertification($professional_certification_id);

        $professionalCertification->setStatus($professionalCertification::STATUS_NOT_REVIEW);
        if (isset($data->identity_card_number)) $professionalCertification->setIdentityCardNumber($data->identity_card_number);
        if (isset($data->certification_image_front)) $professionalCertification->setCertificationImageFront($data->certification_image_front);
        if (isset($data->certification_image_back)) $professionalCertification->setCertificationImageBack($data->certification_image_back);

        $this->em->flush();
        return $professionalCertification;
    }

    public function deleteProfessionalCertification($professional_certification_id)
    {
        $professionalCertification = $this->getProfessionalCertification($professional_certification_id);

        $this->em->remove($professionalCertification);
        $this->em->flush();
        return true;
    }
}