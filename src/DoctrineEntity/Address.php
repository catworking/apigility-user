<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/21
 * Time: 11:20
 */
namespace ApigilityUser\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * Class Address
 * @package ApigilityUser\DoctrineEntity
 * @Entity @Table(name="apigilityuser_address")
 */
class Address
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 省
     *
     * @Column(type="integer", unique=true)
     */
    protected $province;

    /**
     * 市
     *
     * @Column(type="integer", unique=true)
     */
    protected $city;

    /**
     * 区
     *
     * @Column(type="integer", unique=true)
     */
    protected $district;

    /**
     * 详细地址
     *
     * @Column(type="string", length=800, unique=true)
     */
    protected $detail;
}