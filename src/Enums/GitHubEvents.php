<?php

namespace App\Enums;
enum GitHubEvents: string
{
    case CommitComment = 'CommitCommentEvent';
    case Create = 'CreateEvent';
    case Delete = 'DeleteEvent';
    case Discussion = 'DiscussionEvent';
    case Fork = 'ForkEvent';
    case WikiUpdate = 'GollumEvent';
    case IssueComment = 'IssueCommentEvent';
    case Issue = 'IssuesEvent';
    case MemberAdded = 'MemberEvent';
    case RepositoryPublic = 'PublicEvent';
    case PullRequest = 'PullRequestEvent';
    case PullRequestReview = 'PullRequestReviewEvent';
    case PullRequestReviewComment = 'PullRequestReviewCommentEvent';
    case Push = 'PushEvent';
    case Release = 'ReleaseEvent';
    case Watch = 'WatchEvent';

    public function label(): string
    {
        return match($this) {
            self::CommitComment         => 'Commit Commented',
            self::Create                => 'Created',
            self::Delete                => 'Deleted',
            self::Discussion            => 'Discussion',
            self::Fork                  => 'Forked',
            self::WikiUpdate            => 'Wiki Updated',
            self::IssueComment          => 'Issue Commented',
            self::Issue                 => 'Issue Created/Updated',
            self::MemberAdded           => 'Member Added',
            self::RepositoryPublic      => 'Repository Made Public',
            self::PullRequest           => 'Pull Requested',
            self::PullRequestReview     => 'Pull Request Reviewed',
            self::PullRequestReviewComment => 'Pull Request Review Commented',
            self::Push                  => 'Pushed',
            self::Release               => 'Released',
            self::Watch                 => 'Watched',
        };
    }

    public function format(mixed ...$args): string
    {
        $template = match($this) {
            self::Delete => 'Deleted %s times %s',
            self::Push   => 'Pushed %d commits to %s',
            self::PullRequest => 'Pull requested  %d from %s',
            self::Watch => 'Watched %d repository %s',
            self::Create => 'Created %d repository %s',
            default      => $this->label(),
        };

        return empty($args) ? $template : sprintf($template, ...$args);
    }
}