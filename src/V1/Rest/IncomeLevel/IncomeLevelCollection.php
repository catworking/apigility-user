<?php
namespace ApigilityUser\V1\Rest\IncomeLevel;

use ApigilityCatworkFoundation\Base\ApigilityCollection;
use ApigilityUser\DoctrineEntity\IncomeLevel;

class IncomeLevelCollection extends ApigilityCollection
{
    protected $itemType = IncomeLevelEntity::class;
}
