<?php
//
//$args = array_slice($argv, 1);
//
//$username = $args[0];
//
//
//


include __DIR__ . '/../vendor/autoload.php';


use App\Services\GithubService;
use App\Enums\GitHubEvents;
use App\Core\Console;

$githubService = new GithubService();

//$userEvents = $githubService->getUserEvents('otavio-cipriano');

//echo $response;

//$event = GitHubEvents::from('PushEvent');
//echo $event->format(3, 'main');

$console = new Console($githubService);
$console->run($argv);

//TODO: Terminar os placeholders nos textos de resposta
//TODO: Ver como mostrar o que aparece no payload
//TODO: Opcional -> se o evento foi realizado no mesmo dia, ele adiciona no contador, caso contrario, cria nova linha com data
//TODO: Opcional -> basicamente a estrutura do novo array: array[string_data][event][repo]=times