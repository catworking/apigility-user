<?php
namespace ApigilityUser\V1\Rest\ProfessionalCertification;

class ProfessionalCertificationResourceFactory
{
    public function __invoke($services)
    {
        return new ProfessionalCertificationResource($services);
    }
}
