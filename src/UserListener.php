<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/21
 * Time: 15:58
 */
namespace ApigilityUser;

use ApigilityAddress\DoctrineEntity\Address;
use ApigilityAddress\Service\AddressService;
use ApigilityUser\DoctrineEntity\PersonalCertification;
use ApigilityUser\Service\IdentityService;
use ApigilityUser\Service\UserService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;
use ApigilityUser\DoctrineEntity\User;
use ApigilityUser\Service\PersonalCertificationService;

class UserListener
{
    protected $listeners = [];

    private $services;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(IdentityService::EVENT_IDENTITY_CREATED, [$this, 'createUser'], $priority);
    }

    public function attachToPersonalCertificationService(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(PersonalCertificationService::EVENT_STATUS_SWITCH_TO_OK,
            [
                $this,
                'updateUserCensusRegisterAddress'
            ],
            $priority);
    }

    public function createUser(EventInterface $e)
    {
        $params = $e->getParams();

        // 创建用户记录
        $userService = $this->services->get('ApigilityUser\Service\UserService');
        $userService->createUser(json_decode('{"user_id":"'. $params['user_id'] .'"}'));
    }

    public function updateUserCensusRegisterAddress(EventInterface $e)
    {
        $params = $e->getParams();
        $personal_certification = $this->getPersonalCertification($params['personal_certification']);

        // 如果没有户口地址，创建一个
        $address = $personal_certification->getUser()->getCensusRegisterAddress();
        if ($address instanceof Address) {
            // 已有地址，更新
            $temp_address = $this->getAddressService()
                ->createAddressByIdentityCardNumber($personal_certification->getIdentityCardNumber(),
                    null,
                    false);

            $address = $this->getAddressService()->updateAddress($address->getId(), (object)[
                'province'=>$temp_address->getProvince()->getId(),
                'city'=>$temp_address->getCity()->getId(),
                'district'=>$temp_address->getDistrict()->getId()
            ]);
        } else {
            $address = $this->getAddressService()
                ->createAddressByIdentityCardNumber($personal_certification->getIdentityCardNumber());
            $user_data['census_register_address'] = $address->getId();

            // 保存到用户资料
            $this->getUserService()->updateUser($personal_certification->getUser()->getId(), (object)$user_data);
        }
    }

    /**
     * @param $object
     * @return PersonalCertification
     * @throws \Exception
     */
    private function getPersonalCertification($object)
    {
        if ($object instanceof PersonalCertification) return $object;
        else throw new \Exception('对象类型必须为 PersonalCertification', 500);
    }

    /**
     * @return AddressService
     * @throws \Exception
     */
    private function getAddressService()
    {
        $addressService = $this->services->get('ApigilityAddress\Service\AddressService');
        if ($addressService instanceof AddressService) return $addressService;
        else throw new \Exception('对象类型必须为 AddressService', 500);
    }

    /**
     * @return UserService
     * @throws \Exception
     */
    private function getUserService()
    {
        $userService = $this->services->get('ApigilityUser\Service\UserService');
        if ($userService instanceof UserService) return $userService;
        else throw new \Exception('对象类型必须为 UserService', 500);
    }
}