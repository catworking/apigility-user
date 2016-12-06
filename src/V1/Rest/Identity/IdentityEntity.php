<?php
namespace ApigilityUser\V1\Rest\Identity;

use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class IdentityEntity
{
    protected $id;
    protected $phone;

    protected $type;

    public function __construct(\ApigilityUser\DoctrineEntity\Identity $identity)
    {
        $hy = new ClassMethodsHydrator();
        $hy->hydrate($hy->extract($identity), $this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        return $this->phone = $phone;
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
