<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/23
 * Time: 16:54:58
 */
namespace ApigilityUser\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Occupation
 * @package ApigilityUser\DoctrineEntity
 * @Entity @Table(name="apigilityuser_occupation")
 */
class Occupation
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 职业名称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * 关联到此职业的用户
     *
     * @OneToMany(targetEntity="User", mappedBy="occupation")
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    public function getUsers()
    {
        return $this->users;
    }
}