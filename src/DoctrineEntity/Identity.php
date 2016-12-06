<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/7
 * Time: 10:49
 */

namespace ApigilityUser\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;

/**
 * Class Identity
 * @package ApigilityUser\DoctrineEntity
 * @Entity @Table(name="apigilityuser_identity")
 */
class Identity
{
    /**
     * @Id @Column(type="string")
     */
    protected $id;

    /**
     * @Column(type="string", unique=true)
     */
    protected $phone;

    /**
     * 类型
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $type;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
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