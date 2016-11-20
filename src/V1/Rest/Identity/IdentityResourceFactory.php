<?php
namespace ApigilityUser\V1\Rest\Identity;

class IdentityResourceFactory
{
    public function __invoke($services)
    {
        return new IdentityResource($services);
    }
}
