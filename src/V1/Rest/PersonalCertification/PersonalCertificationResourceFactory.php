<?php
namespace ApigilityUser\V1\Rest\PersonalCertification;

class PersonalCertificationResourceFactory
{
    public function __invoke($services)
    {
        return new PersonalCertificationResource();
    }
}
