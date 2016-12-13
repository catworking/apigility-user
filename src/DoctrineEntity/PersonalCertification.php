<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/13
 * Time: 15:28
 */
namespace ApigilityUser\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use ApigilityUser\DoctrineEntity\User;

/**
 * Class PersonalCertification
 * @package ApigilityUser\DoctrineEntity
 * @Entity @Table(name="apigilityuser_personal_certification")
 */
class PersonalCertification
{
    const STATUS_NOT_REVIEW = 1;
    const STATUS_REVIEWED_REJECT = 2;
    const STATUS_REVIEWED_OK = 3;

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=50, nullable=true)
     */
    protected $identity_card_number;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $identity_card_image_front;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    protected $identity_card_image_back;

    /**
     * 用户
     *
     * @OneToOne(targetEntity="User", inversedBy="personalCertification")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * 审核状态
     *
     * @Column(type="smallint", nullable=false)
     */
    protected $status;



    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setIdentityCardNumber($identity_card_number)
    {
        $this->identity_card_number = $identity_card_number;
        return $this;
    }

    public function getIdentityCardNumber()
    {
        return $this->identity_card_number;
    }

    public function setIdentityCardImageFront($identity_card_image_front)
    {
        $this->identity_card_image_front = $identity_card_image_front;
        return $this;
    }

    public function getIdentityCardImageFront()
    {
        return $this->identity_card_image_front;
    }

    public function setIdentityCardImageBack($identity_card_image_back)
    {
        $this->identity_card_image_back = $identity_card_image_back;
        return $this;
    }

    public function getIdentityCardImageBack()
    {
        return $this->identity_card_image_back;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
}