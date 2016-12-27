<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 13:46
 */
namespace ApigilityUser\Service;

use ApigilityAddress\Service\AddressService;
use ApigilityCatworkFoundation\Base\ApigilityEventAwareObject;
use ApigilityUser\DoctrineEntity\User;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Hydrator\ObjectProperty as ObjectPropertyHydrator;

class UserService extends ApigilityEventAwareObject
{
    const EVENT_USER_CREATED = 'UserService.EventUserCreated';
    const EVENT_USER_NICKNAME_UPDATE = 'UserService.EVENT_USER_NICKNAME_UPDATE';

    protected $em;
    protected $classMethodsHydrator;
    protected $objectPropertyHydrator;

    /**
     * @var \ZF\MvcAuth\Identity\AuthenticatedIdentity
     */
    protected $authIdentity;

    protected $services;

    /**
     * @var IdentityService
     */
    protected $identityService;

    /**
     * @var OccupationService
     */
    protected $occupationService;

    /**
     * @var IncomeLevelService
     */
    protected $incomeLevelService;

    /**
     * @var AddressService
     */
    protected $addressService;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->identityService = $services->get('ApigilityUser\Service\IdentityService');
        $this->occupationService = $services->get('ApigilityUser\Service\OccupationService');
        $this->incomeLevelService = $services->get('ApigilityUser\Service\IncomeLevelService');
        $this->addressService = $services->get('ApigilityAddress\Service\AddressService');
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->objectPropertyHydrator = new ObjectPropertyHydrator();
    }

    /**
     * 创建一个用户
     * @param $data
     * @return User
     */
    public function createUser($data)
    {
        $user = new User();
        $user->setId($data->user_id);

        if (isset($data->nickname)) $user->setNickname($data->nickname);
        else {
            $identity = $this->identityService->getIdentity($data->user_id);
            $nickname = '用户'.substr($identity->getPhone(), 0, 3).'****'.substr($identity->getPhone(), -4, 4);
            $user->setNickname($nickname);
        }

        $this->hydrateUserData($user, $data);

        $this->em->persist($user);
        $this->em->flush();

        $this->getEventManager()->trigger(self::EVENT_USER_CREATED, $this, ['user' => $user]);

        return $user;
    }

    /**
     * 获取单个用户信息
     *
     * @param $user_id
     * @return \ApigilityUser\DoctrineEntity\User
     * @throws Exception\UserNotExistException
     */
    public function getUser($user_id)
    {
        $user = $this->em->find('ApigilityUser\DoctrineEntity\User', $user_id);
        if (empty($user)) throw new Exception\UserNotExistException();

        return $user;
    }

    /**
     * 更新单个用户信息
     *
     * @param $user_id
     * @param $data
     * @return mixed
     */
    public function updateUser($user_id, $data)
    {
        $user = $this->getUser($user_id);

        $this->hydrateUserData($user, $data);

        $this->em->flush();

        if (isset($data->nickname)) {
            // 触发事件
            $this->getEventManager()->trigger(self::EVENT_USER_NICKNAME_UPDATE, $this, ['user' => $user]);
        }

        return $user;
    }

    /**
     * 获取已登录的用户对象
     * @return \ApigilityUser\DoctrineEntity\User
     */
    public function getAuthUser()
    {
        $this->authIdentity = $this->services->get('api-identity');
        return  $this->getUser($this->authIdentity->getRoleId());
    }

    /**
     * @param User $user
     * @param $data
     */
    private function hydrateUserData(User $user, $data)
    {
        if (isset($data->nickname)) $user->setNickname($data->nickname);
        if (isset($data->avatar)) $user->setAvatar($data->avatar);
        if (isset($data->sex)) $user->setSex($data->sex);
        if (isset($data->age)) $user->setAge($data->age);
        if (isset($data->stature)) $user->setStature($data->stature);
        if (isset($data->weight)) $user->setWeight($data->weight);
        if (isset($data->education)) $user->setEducation($data->education);
        if (isset($data->emotion)) $user->setEmotion($data->emotion);
        if (isset($data->zodiac)) $user->setZodiac($data->zodiac);
        if (isset($data->chinese_zodiac)) $user->setChineseZodiac($data->chinese_zodiac);

        if (isset($data->birthday)) {
            $datetime = new \DateTime();
            $datetime->setTimestamp($data->birthday);
            $user->setBirthday($datetime);
        }

        if (isset($data->income_level)) $user->setIncomeLevel($this->incomeLevelService->getIncomeLevel($data->income_level));
        if (isset($data->occupation)) $user->setOccupation($this->occupationService->getOccupation($data->occupation));
        if (isset($data->residence_address)) $user->setResidenceAddress($this->addressService->getAddress($data->residence_address));
        if (isset($data->census_register_address)) $user->setCensusRegisterAddress($this->addressService->getAddress($data->census_register_address));
    }
}