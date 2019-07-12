<?php

namespace App;

use App\OParl\OParlApiManager;
use Illuminate\Support\Arr;

class Meeting
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        return Arr::get($this->data, $name);
    }

    public function location()
    {
        return Arr::has($this->data, 'location') ? new Location($this->location) : null;
    }

    public function organization()
    {
        if ($organizationId = collect($this->organization)->first()) {
            return OParlApiManager::organization($organizationId);
        }

        return null;
    }

    public function organizations()
    {
        $organizationIds = collect($this->organization)->map(function ($organizationUrl) {
            return $this->extractOrganizationId($organizationUrl);
        });

        return OParlApiManager::organizations($organizationIds);
    }

    private function extractOrganizationId(string $organizationUrl)
    {
        return Arr::last(explode('/', $organizationUrl));
    }

    public function extractId()
    {
        return Arr::last(explode('/', $this->id));
    }

    public function agendaCount()
    {
        return $this->agendaItem ? count($this->agendaItem) : 0;
    }

    public function peopleCount()
    {
        return $this->organizations()->map(function($organization) {
            return $organization->peopleCount();
        })->sum();
    }

    public function fileCount()
    {
        return (int)((bool)$this->invitation) +
            (int)((bool)$this->resultsProtocol) +
            (int)((bool)$this->verbatimProtocol) +
            ($this->auxiliaryFile ? count($this->auxiliaryFile) : 0);
    }

}
