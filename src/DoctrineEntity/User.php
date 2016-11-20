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
    /**
     * @Id @Column(type="string")
     */
    protected $id;

    /**
     * @Column(type="string")
     */
    protected $name;
}