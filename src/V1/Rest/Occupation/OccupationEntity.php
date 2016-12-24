<?php
namespace ApigilityUser\V1\Rest\Occupation;

use ApigilityCatworkFoundation\Base\ApigilityEntity;

class OccupationEntity extends ApigilityEntity
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
        return $this->users->count();
    }
}
