<?php

namespace App\OParl;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OParlApi implements \App\Contracts\OParlApi
{
    private $domain;
    private $bodyId;
    private $client;

    public function __construct(string $domain, string $bodyId)
    {
        $this->domain = $domain;
        $this->bodyId = $bodyId;

        $this->client = new Client([
            'base_uri' => $domain,
        ]);
    }

    private function call(string $method, string $endpoint, int $page = null) {
        if ($data = $this->getCache($method, $endpoint, $page)) {
            return $data;
        }

        $urlConcat = Str::contains($endpoint, '?') ? '&' : '?';

        try {
            $response = $this->client->request($method, sprintf('%s%spage=%s', $endpoint, $urlConcat , $page));
        } catch (\Exception $exception) {
            Log::error(get_class($exception) . ' threw ' . $exception->getMessage());
        }

        $data = json_decode($response->getBody()->getContents(), true);

        if (!$data) {
            $data = [];
        }

        $this->setCache(
            $data,
            $method,
            $endpoint,
            $page
        );

        return $data;
    }

    private function getCacheHash(string $method, string $endpoint, int $page = null)
    {
        return md5(sprintf('%s%s%s%s%s',$this->domain ,$this->bodyId, $method, $endpoint, $page));
    }

    private function getCache(string $method, string $endpoint, int $page = null)
    {
        return Cache::get($this->getCacheHash($method, $endpoint, $page));
    }

    private function setCache(array $data, string $method, string $endpoint, int $page = null)
    {
        Cache::put($this->getCacheHash($method, $endpoint, $page), $data, now()->addMinutes(10));
    }

    public function papers(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'paper');

        return $this->call('GET', $endpoint, $page);
    }

    public function people(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'person');

        return $this->call('GET', $endpoint, $page);
    }

    public function locations(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'location');

        return $this->call('GET', $endpoint, $page);
    }

    public function meetings(int $page = null, Carbon $from = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'meeting');

        if ($from) {
            $endpoint .= '?' . 'created_since=' . urlencode($from->toIso8601String());
        }

        return $this->call('GET', $endpoint, $page);
    }

    public function organizations(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'organization');

        return $this->call('GET', $endpoint, $page);
    }

    public function memberships(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'membership');

        return $this->call('GET', $endpoint, $page);
    }


    public function agendaItems(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'agenda_item');

        return $this->call('GET', $endpoint, $page);
    }

    public function consultations(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'consultation');

        return $this->call('GET', $endpoint, $page);
    }

    public function files(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'file');

        return $this->call('GET', $endpoint, $page);
    }

    public function person(string $id)
    {
        $endpoint = sprintf('%s/%s','person', $id);

        return $this->call('GET', $endpoint);
    }

    public function membership(string $id)
    {
        $endpoint = sprintf('%s/%s','membership', $id);

        return $this->call('GET', $endpoint);
    }

    public function meeting(string $id)
    {
        $endpoint = sprintf('%s/%s','meeting', $id);

        return $this->call('GET', $endpoint);
    }

    public function organization(string $organizationID, int $page = null)
    {
        $endpoint = sprintf('%s/%s', 'organization', $organizationID);

        return $this->call('GET', $endpoint, $page);
    }

}
