<?php
include __DIR__ . '/../vendor/autoload.php';


use App\Services\GithubService;
use App\Core\Console;

$githubService = new GithubService();
$console = new Console($githubService);
$console->run($argv);