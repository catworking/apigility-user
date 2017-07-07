<?php
namespace ApigilityUser\V1\Rest\IncomeLevel;

use ApigilityCatworkFoundation\Base\ApigilityEntity;

class IncomeLevelEntity extends ApigilityEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 最小收入
     *
     * @Column(type="decimal", precision=7, scale=2, nullable=true)
     */
    protected $min_income;

    /**
     * 最大收入
     *
     * @Column(type="decimal", precision=7, scale=2, nullable=true)
     */
    protected $max_income;

    /**
     * 关联到此等级的用户
     *
     * @OneToMany(targetEntity="User", mappedBy="income_level")
     */
    protected $users;


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
        return $this->users->count();
    }
}
