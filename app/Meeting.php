<?php

namespace App;

use App\OParl\OParlApiManager;
use Illuminate\Support\Arr;

class Meeting extends Model
{
    public function location()
    {
        return Arr::has($this->data, 'location') ? new Location($this->location) : null;
    }

    public function organization()
    {
        if ($organizationUrl = collect($this->organization)->first()) {
            return OParlApiManager::organization($this->extractIdFromUrl($organizationUrl));
        }

        return null;
    }

    public function organizations()
    {
        $organizationIds = collect($this->organization)->map(function ($organizationUrl) {
            return $this->extractIdFromUrl($organizationUrl);
        });

        return OParlApiManager::organizations($organizationIds);
    }

    public function files()
    {
        $files = collect($this->auxiliaryFile)->map(function ($auxiliaryFile) {
            return new File($auxiliaryFile);
        });

        if ($this->vebatimProtocol) {
            $files->push(new File($this->invitation));
        }
        if ($this->vebatimProtocol) {
            $files->push(new File($this->vebatimProtocol));
        }

        return $files;
    }

    private function extractIdFromUrl(string $url)
    {
        return Arr::last(explode('/', $url));
    }

    public function agenda()
    {
        return collect($this->agendaItem)->map(function ($agendaItem) {
            return new Agendum($agendaItem);
        });
    }

    public function agendaCount()
    {
        return $this->agendaItem ? count($this->agendaItem) : 0;
    }

    public function people()
    {
        return $this->organizations()->map(function($organization) {
            return collect($organization->membership)->map(function($membershipUrl) {
                return OParlApiManager::personFromMembership($this->extractIdFromUrl($membershipUrl));
            });
        })->flatten(1);
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
