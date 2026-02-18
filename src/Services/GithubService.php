<?php

namespace App\Services;

class GithubService
{
    private string $baseURl = 'https://api.github.com/users';

    private CurlService $curlService;

    public function __construct()
    {
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
        return json_decode($this->curlService->get("$username/events"), true);
    }

}