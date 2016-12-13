<?php
namespace ApigilityUser\V1\Rest\PersonalCertification;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class PersonalCertificationCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = PersonalCertificationEntity::class;
}
