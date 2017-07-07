<?php
namespace ApigilityUser\V1\Rest\IncomeLevel;

class IncomeLevelResourceFactory
{
    public function __invoke($services)
    {
        return new IncomeLevelResource($services);
    }
}
