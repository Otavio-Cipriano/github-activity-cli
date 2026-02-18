<?php

namespace App\Services;

use CurlHandle;

class CurlService
{
    private string $baseUrl;
    private CurlHandle|bool $curl;

    private array $headers;

    private array $body;

    private string $userAgent;
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->curl = curl_init();
    }

    public function setUserAgent(string $agent)
    {
        $this->userAgent = $agent;
    }

    public function setHeaders(array $options): void
    {
        $this->headers = $options;
    }

    public function get(string $path): bool|string
    {
        curl_setopt_array($this->curl, [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER  => $this->headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => "$this->baseUrl/$path",
            CURLOPT_USERAGENT => $this->userAgent,

        ]);

        $response = curl_exec($this->curl);
        if ($response === false) {
            echo curl_error($this->curl);
        }
        curl_close($this->curl);
        return $response;
    }


}