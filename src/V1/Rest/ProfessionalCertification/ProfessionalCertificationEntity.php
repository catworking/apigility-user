<?php
namespace ApigilityUser\V1\Rest\ProfessionalCertification;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityUser\DoctrineEntity\User;

class ProfessionalCertificationEntity extends ApigilityObjectStorageAwareEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=50, unique=true)
     */
    protected $identity_card_number;

    /**
     * @Column(type="string", length=255, unique=true)
     */
    protected $certification_image_front;

    /**
     * @Column(type="string", length=255, unique=true)
     */
    protected $certification_image_back;

    /**
     * 用户
     *
     * @ManyToOne(targetEntity="User", inversedBy="professionalCertifications")
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

    public function setCertificationImageFront($certification_image_front)
    {
        $this->certification_image_front = $certification_image_front;
        return $this;
    }

    public function getCertificationImageFront()
    {
        if (empty($this->certification_image_front)) return $this->certification_image_front;
        else return $this->renderUriToUrl($this->certification_image_front);
    }

    public function setCertificationImageBack($certification_image_back)
    {
        $this->certification_image_back = $certification_image_back;
        return $this;
    }

    public function getCertificationImageBack()
    {
        if (empty($this->certification_image_back)) return $this->certification_image_back;
        else return $this->renderUriToUrl($this->certification_image_back);
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        if ($this->user instanceof User) return (object)[];
        else return $this->user;
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
