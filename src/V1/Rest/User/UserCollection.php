<?php
namespace ApigilityUser\V1\Rest\User;


use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class UserCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = UserEntity::class;
}
