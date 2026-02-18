<?php

namespace App\Services;

class GithubService
{
    private string $baseURl = 'https://api.github.com/users';

    private CurlService $curlService;

    private CacheService $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
        $this->curlService = new CurlService($this->baseURl);
        $this->curlService->setHeaders([
            "Content-Type: application/json",
            "User-Agent: MyApp", // GitHub needs
            'Accept: application/json'
        ]);
        $this->curlService->setUserAgent('MyApp');
    }

    public function getUserEvents(string $username): array|false
    {
        $cacheKey = 'userEvents';
        $cachedUserEvents = $this->cacheService->get($cacheKey);
        if($cachedUserEvents) return $cachedUserEvents;

        $userEvents = json_decode($this->curlService->get("$username/events"), true);
        $this->cacheService->set($cacheKey,$userEvents);
        return $userEvents;
    }

}