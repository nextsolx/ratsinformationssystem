<?php

namespace App\Contracts;

use Illuminate\Support\Carbon;

interface OParlApi
{
    public function meetings($page = null, Carbon $from = null);
    public function organization(string $organizationId);
}
