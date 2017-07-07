<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/23
 * Time: 17:04:32
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
 * Class IncomeLevel
 * @package ApigilityUser\DoctrineEntity
 * @Entity @Table(name="apigilityuser_income_level")
 */
class IncomeLevel
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 最小收入
     *
     * @Column(type="decimal", precision=11, scale=2, nullable=true)
     */
    protected $min_income;

    /**
     * 最大收入
     *
     * @Column(type="decimal", precision=11, scale=2, nullable=true)
     */
    protected $max_income;

    /**
     * 关联到此等级的用户
     *
     * @OneToMany(targetEntity="User", mappedBy="income_level")
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

    public function setMinIncome($min_income)
    {
        $this->min_income = $min_income;
        return $this;
    }

    public function getMinIncome()
    {
        return $this->min_income;
    }

    public function setMaxIncome($max_income)
    {
        $this->max_income = $max_income;
        return $this;
    }

    public function getMaxIncome()
    {
        return $this->max_income;
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