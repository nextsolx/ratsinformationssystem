<?php

namespace App\Contracts;

interface OParlApi
{
    public function meetings();
    public function organization(string $organizationId);
}
