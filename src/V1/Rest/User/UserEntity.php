<?php
namespace ApigilityUser\V1\Rest\User;

use ApigilityAddress\DoctrineEntity\Address;
use ApigilityAddress\V1\Rest\Address\AddressEntity;
use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityUser\DoctrineEntity\IncomeLevel;
use ApigilityUser\DoctrineEntity\Occupation;
use ApigilityUser\DoctrineEntity\PersonalCertification;
use ApigilityUser\V1\Rest\IncomeLevel\IncomeLevelEntity;
use ApigilityUser\V1\Rest\Occupation\OccupationEntity;
use ApigilityUser\V1\Rest\PersonalCertification\PersonalCertificationEntity;
use ApigilityUser\V1\Rest\ProfessionalCertification\ProfessionalCertificationEntity;

class UserEntity extends ApigilityObjectStorageAwareEntity
{
    /**
     * 用户标识
     *
     * @Id @Column(type="string", length=255, nullable=false)
     */
    protected $id;

    /**
     * 昵称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $nickname;

    /**
     * 头像地址
     *
     * @Column(type="string", length=255, nullable=true)
     */
    protected $avatar;

    /**
     * 性别
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $sex;

    /**
     * 年龄
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $age;

    /**
     * 生日
     *
     * @Column(type="datetime", nullable=true)
     */
    protected $birthday;

    /**
     * 身高
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $stature;

    /**
     * 体重
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $weight;

    /**
     * 学历
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $education;

    /**
     * 感情状态
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $emotion;

    /**
     * 星座
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $zodiac;

    /**
     * 生肖
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $chinese_zodiac;

    /**
     * 居住地址
     *
     * @OneToOne(targetEntity="ApigilityAddress\DoctrineEntity\Address")
     * @JoinColumn(name="residence_address_id", referencedColumnName="id")
     */
    protected $residence_address;

    /**
     * 户口地址
     *
     * @OneToOne(targetEntity="ApigilityAddress\DoctrineEntity\Address")
     * @JoinColumn(name="census_register_address_id", referencedColumnName="id")
     */
    protected $census_register_address;

    /**
     * 个人实名认证
     *
     * @OneToOne(targetEntity="PersonalCertification", mappedBy="user")
     */
    protected $personalCertification;

    /**
     * 职业认证
     *
     * @OneToMany(targetEntity="ProfessionalCertification", mappedBy="user")
     */
    protected $professionalCertifications;

    /**
     * 职业
     *
     * @ManyToOne(targetEntity="Occupation", inversedBy="users")
     * @JoinColumn(name="occupation_id", referencedColumnName="id")
     */
    protected $occupation;

    /**
     * 收入等级
     *
     * @ManyToOne(targetEntity="IncomeLevel", inversedBy="users")
     * @JoinColumn(name="income_level_id", referencedColumnName="id")
     */
    protected $income_level;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getAvatar()
    {
        return $this->renderUriToUrl($this->avatar);
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setBirthday($birthday)
    {
        if ($birthday instanceof \DateTime) {
            $this->birthday = $birthday->getTimestamp();
        } else {
            $this->birthday = $birthday;
        }

        return $this;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setStature($stature)
    {
        $this->stature = $stature;
        return $this;
    }

    public function getStature()
    {
        return $this->stature;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setEducation($education)
    {
        $this->education = $education;
        return $this;
    }

    public function getEducation()
    {
        return $this->education;
    }

    public function setEmotion($emotion)
    {
        $this->emotion = $emotion;
        return $this;
    }

    public function getEmotion()
    {
        return $this->emotion;
    }

    public function setZodiac($zodiac)
    {
        $this->zodiac = $zodiac;
        return $this;
    }

    public function getZodiac()
    {
        return $this->zodiac;
    }

    public function setChineseZodiac($chinese_zodiac)
    {
        $this->chinese_zodiac = $chinese_zodiac;
        return $this;
    }

    public function getChineseZodiac()
    {
        return $this->chinese_zodiac;
    }



    public function setPersonalCertification($personalCertification)
    {
        $this->personalCertification = $personalCertification;
        return $this;
    }

    public function getPersonalCertification()
    {
        if ($this->personalCertification instanceof PersonalCertification) return $this->hydrator->extract(new PersonalCertificationEntity($this->personalCertification, $this->serviceManager));
        else return $this->personalCertification;
    }

    public function setProfessionalCertifications($professionalCertifications)
    {
        $this->professionalCertifications = $professionalCertifications;
        return $this;
    }

    public function getProfessionalCertifications()
    {
        return $this->getJsonValueFromDoctrineCollection($this->professionalCertifications, ProfessionalCertificationEntity::class, $this->serviceManager);
    }

    public function addProfessionalCertification($professionalCertification)
    {
        $this->professionalCertifications[] = $professionalCertification;
    }

    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    public function getOccupation()
    {
        if ($this->occupation instanceof Occupation) return $this->hydrator->extract(new OccupationEntity($this->occupation));
        else return $this->occupation;
    }

    public function setIncomeLevel($income_level)
    {
        $this->income_level = $income_level;
        return $this;
    }

    public function getIncomeLevel()
    {
        if ($this->income_level instanceof IncomeLevel) return $this->hydrator->extract(new IncomeLevelEntity($this->income_level));
        else return $this->income_level;
    }

    public function setResidenceAddress($residence_address)
    {
        $this->residence_address = $residence_address;
        return $this;
    }

    public function getResidenceAddress()
    {
        if ($this->residence_address instanceof Address) return $this->hydrator->extract(new AddressEntity($this->residence_address));
        else return $this->residence_address;
    }

    public function setCensusRegisterAddress($census_register_address)
    {
        $this->census_register_address = $census_register_address;
        return $this;
    }

    public function getCensusRegisterAddress()
    {
        if ($this->census_register_address instanceof Address) return $this->hydrator->extract(new AddressEntity($this->census_register_address));
        else return $this->census_register_address;
    }
}
