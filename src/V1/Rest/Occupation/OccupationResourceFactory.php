<?php
namespace ApigilityUser\V1\Rest\Occupation;

class OccupationResourceFactory
{
    public function __invoke($services)
    {
        return new OccupationResource($services);
    }
}
