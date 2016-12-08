<?php
namespace ApigilityUser\V1\Rest\Identity;

use ApigilityCatworkFoundation\Base\ApigilityCollection;

class IdentityCollection extends ApigilityCollection
{
    protected $itemType = IdentityEntity::class;
}
