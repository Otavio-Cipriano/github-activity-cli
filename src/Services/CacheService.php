<?php

namespace App\Services;

class CacheService
{
    private string $dir = __DIR__ . '/../../cache/';

    private int $ttl;

    public function __construct(int $ttl = 600)
    {
        $this->ttl = $ttl;
    }

    public function get(string $key): ?array
    {
        $file = "$this->dir/$key.json";
        if(!file_exists($file)) return null;
        $age = time() - filemtime($file);
        if($age > $this->ttl) return null;

        return json_decode(file_get_contents($file), true);
    }

    public function set(string $key, array $data): void
    {
        if (!is_dir($this->dir)) mkdir($this->dir, 0755, true);
        file_put_contents("$this->dir/$key.json", json_encode($data, JSON_PRETTY_PRINT));
    }
}