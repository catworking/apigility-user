<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/13
 * Time: 16:23
 */
namespace ApigilityUser\Service;

use ApigilityCatworkFoundation\Base\ApigilityEventAwareObject;
use ApigilityUser\DoctrineEntity\User;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityUser\DoctrineEntity;

class PersonalCertificationService extends ApigilityEventAwareObject
{
    const EVENT_STATUS_SWITCH_TO_OK = 'PersonalCertificationService.EVENT_STATUS_SWITCH_TO_OK';

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
     * @param $data
     * @param User $user
     * @return DoctrineEntity\PersonalCertification
     */
    public function createPersonalCertification($data, User $user)
    {
        $personalCertification = new DoctrineEntity\PersonalCertification();
        $personalCertification->setStatus($personalCertification::STATUS_NOT_REVIEW);
        if (isset($data->identity_card_number)) $personalCertification->setIdentityCardNumber($data->identity_card_number);
        if (isset($data->identity_card_image_front)) $personalCertification->setIdentityCardImageFront($data->identity_card_image_front);
        if (isset($data->identity_card_image_back)) $personalCertification->setIdentityCardImageBack($data->identity_card_image_back);
        if (isset($data->holding_identity_card_image)) $personalCertification->setHoldingIdentityCardImage($data->holding_identity_card_image);
        $personalCertification->setUser($user);

        $this->em->persist($personalCertification);
        $this->em->flush();

        return $personalCertification;
    }

    /**
     * @param $personal_certification_id
     * @return DoctrineEntity\PersonalCertification
     * @throws \Exception
     */
    public function getPersonalCertification($personal_certification_id)
    {
        $personalCertification = $this->em->find('ApigilityUser\DoctrineEntity\PersonalCertification', $personal_certification_id);
        if (empty($personalCertification)) throw new \Exception('实名认证信息不存在', 404);
        else return $personalCertification;
    }

    public function getPersonalCertifications($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('pc')->from('ApigilityUser\DoctrineEntity\PersonalCertification', 'pc');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * @param $personal_certification_id
     * @param $data
     * @return DoctrineEntity\PersonalCertification
     */
    public function updatePersonalCertification($personal_certification_id, $data)
    {
        $personalCertification = $this->getPersonalCertification($personal_certification_id);

        if (isset($data->status)) {
            $personalCertification->setStatus($data->status);
        } else {
            $personalCertification->setStatus(DoctrineEntity\PersonalCertification::STATUS_NOT_REVIEW);
        }
        if (isset($data->identity_card_number)) $personalCertification->setIdentityCardNumber($data->identity_card_number);
        if (isset($data->identity_card_image_front)) $personalCertification->setIdentityCardImageFront($data->identity_card_image_front);
        if (isset($data->identity_card_image_back)) $personalCertification->setIdentityCardImageBack($data->identity_card_image_back);
        if (isset($data->holding_identity_card_image)) $personalCertification->setHoldingIdentityCardImage($data->holding_identity_card_image);

        $this->em->flush();

        if (isset($data->status) && $data->status == DoctrineEntity\PersonalCertification::STATUS_REVIEWED_OK) {
            // 触发审核通过事件
            $this->getEventManager()->trigger(self::EVENT_STATUS_SWITCH_TO_OK, $this, ['personal_certification' => $personalCertification]);
        }

        return $personalCertification;
    }

    public function deletePersonalCertification($personal_certification_id)
    {
        $personalCertification = $this->getPersonalCertification($personal_certification_id);

        $this->em->remove($personalCertification);
        $this->em->flush();
        return true;
    }
}