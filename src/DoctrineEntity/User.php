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
}