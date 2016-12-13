<?php
namespace ApigilityUser\V1\Rest\ProfessionalCertification;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class ProfessionalCertificationCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = ProfessionalCertificationEntity::class;
}
