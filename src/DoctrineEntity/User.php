<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/7
 * Time: 10:45
 */

namespace ApigilityUser\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Class User
 * @package ApigilityUser\DoctrineEntity
 * @Entity @Table(name="apigilityuser_user")
 */
class User
{
    const SEX_MALE = 1;    // 男性
    const SEX_FEMALE = 2;  // 女性

    const EDUCATION_NONE = 1;        // 没有受过教育
    const EDUCATION_ELEMENTARY = 2;  // 小学
    const EDUCATION_JUNIOR_HIGH = 3; // 初中
    const EDUCATION_SENIOR_HIGH = 4; // 高中
    const EDUCATION_COLLEGE = 5;   // 大专
    const EDUCATION_BACHELOR = 6;  // 本科
    const EDUCATION_MASTER = 7; // 硕士
    const EDUCATION_DOCTOR = 8; // 博士

    const EMOTION_SINGLE = 1;  // 单身
    const EMOTION_IN_LOVE = 2;  // 热恋
    const EMOTION_MARRIED = 3;  // 已婚

    const ZODIAC_CAPRICORN = 1; // 魔羯座
    const ZODIAC_AQUARIUS = 2; // 水瓶座
    const ZODIAC_PISCES = 3; // 双鱼座
    const ZODIAC_ARIES = 4; // 牡羊座
    const ZODIAC_TAURUS = 5; // 金牛座
    const ZODIAC_GEMINI = 6; // 双子座
    const ZODIAC_CANCER = 7; // 巨蟹座
    const ZODIAC_LEO = 8; // 狮子座
    const ZODIAC_VIRGO = 9; // 处女座
    const ZODIAC_LIBRA = 10; // 天秤座
    const ZODIAC_SCORPIO = 11; // 天蝎座
    const ZODIAC_SAGITTARIUS = 12; // 射手座
    
    const CHINESE_ZODIAC_RAT = 1; // 鼠
    const CHINESE_ZODIAC_OX = 2; // 牛
    const CHINESE_ZODIAC_TIGER = 3; // 虎
    const CHINESE_ZODIAC_HARE = 4; // 兔
    const CHINESE_ZODIAC_DRAGON = 5; // 龙
    const CHINESE_ZODIAC_SNAKE = 6; // 蛇
    const CHINESE_ZODIAC_HORSE = 7; // 马
    const CHINESE_ZODIAC_SHEEP = 8; // 羊
    const CHINESE_ZODIAC_MONKEY = 9; // 猴
    const CHINESE_ZODIAC_COCK = 10; // 鸡
    const CHINESE_ZODIAC_DOG = 11; // 狗
    const CHINESE_ZODIAC_BOAR = 12; // 猪

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

    public function setId ($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId ()
    {
        return $this->id;
    }

    public function setNickname ($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getNickname ()
    {
        return $this->nickname;
    }

    public function setAvatar ($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getAvatar ()
    {
        return $this->avatar;
    }

    public function setSex ($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    public function getSex ()
    {
        return $this->sex;
    }

    public function setAge ($age)
    {
        $this->age = $age;
        return $this;
    }

    public function getAge ()
    {
        return $this->age;
    }

    public function setBirthday (\DateTime $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getBirthday ()
    {
        return $this->birthday;
    }

    public function setStature ($stature)
    {
        $this->stature = $stature;
        return $this;
    }

    public function getStature ()
    {
        return $this->stature;
    }

    public function setWeight ($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWeight ()
    {
        return $this->weight;
    }

    public function setEducation ($education)
    {
        $this->education = $education;
        return $this;
    }

    public function getEducation ()
    {
        return $this->education;
    }

    public function setEmotion ($emotion)
    {
        $this->emotion = $emotion;
        return $this;
    }

    public function getEmotion ()
    {
        return $this->emotion;
    }

    public function setZodiac ($zodiac)
    {
        $this->zodiac = $zodiac;
        return $this;
    }

    public function getZodiac ()
    {
        return $this->zodiac;
    }

    public function setChineseZodiac ($chinese_zodiac)
    {
        $this->chinese_zodiac = $chinese_zodiac;
        return $this;
    }

    public function getChineseZodiac ()
    {
        return $this->chinese_zodiac;
    }
}