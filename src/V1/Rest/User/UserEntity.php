<?php
namespace ApigilityUser\V1\Rest\User;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;

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
     * 家庭住址
     *
     * @OneToOne(targetEntity="Address")
     * @JoinColumn(name="home_address", referencedColumnName="id")
     */
    protected $home_address;

    /**
     * 用户类型
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $type;

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

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
}
