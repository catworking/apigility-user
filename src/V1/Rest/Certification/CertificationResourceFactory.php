<?php
namespace ApigilityUser\V1\Rest\Certification;

class CertificationResourceFactory
{
    public function __invoke($services)
    {
        return new CertificationResource();
    }
}
