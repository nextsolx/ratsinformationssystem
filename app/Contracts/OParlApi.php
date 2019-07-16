<?php

namespace App\Contracts;

use Illuminate\Support\Carbon;

interface OParlApi
{
    public function papers(int $page = null);
    public function meeting(string $id);
    public function meetings(int $page = null, Carbon $from = null);
    public function organization(string $organizationId);
    public function person(string $id);
    public function membership(string $id);
}
