<?php

namespace App\Core;

use App\Enums\GitHubEvents;
use App\Services\GithubService;

class Console
{
    private GithubService $githubService;


    public function __construct(GithubService $githubService)
    {
        $this->githubService = $githubService;
    }

    public function run(array $args): void
    {
        if (count($args) > 1) {
            $executable = array_shift($args);
            $username = array_shift($args);
            $response = $this->githubService->getUserEvents($username);
            $this->outputEvents($response);
            return;
        }

        $this->outputHelp();
    }

    private function outputHelp(): void
    {
        echo "No username was provided";
    }

    private function outputEvents($events): void
    {
        echo "\n**** GitHub Events ****\n\n";

        $counted = [];

        foreach ($events as $event) {
            $gitEvent = GitHubEvents::from($event['type']);
            $repo = $event['repo']['name'] ?? 'Unknown';
            $key = $gitEvent->value . '|' . $repo;

            if (!isset($counted[$key])) {
                $counted[$key] = [
                    'event' => $gitEvent,
                    'repo' => $repo,
                    'times' => 0
                ];
            }

            $counted[$key]['times']++;
        }

        foreach ($counted as $entry) {
            echo '- ' . $entry['event']->format($entry['times'], $entry['repo']) . PHP_EOL;
        }

    }
}