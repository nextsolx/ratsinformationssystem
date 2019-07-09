<?php

namespace App\OParl;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class OParlApi
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

        $response = $this->client->request($method, sprintf('%s?page=%s', $endpoint, $page));

        $data = json_decode($response->getBody()->getContents(), true);

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

    public function meetings(int $page = null)
    {
        $endpoint = sprintf('body/%s/%s', $this->bodyId, 'meeting');

        dd($this->call('GET', $endpoint, $page));
        return $this->call('GET', $endpoint, $page);
    }

    public function organization(string $organizationID, int $page = null)
    {
        $endpoint = sprintf('%s/%s', 'organization', $organizationID);

        return $this->call('GET', $endpoint, $page);
    }
}
