# GitHub Activity Cli
CLI application developed in PHP to consult a GitHub user's activity, such as pull requests, pushes, issues, and more. The application is Object-Oriented, uses a layered architecture, cURL for HTTP requests, and JSON files to cache responses for 10 minutes

## Table of Contents
- [Objective](#objective)
- [Features](#features)
- [Technical Decisions](#technical-decisions)
- [Limitations and Future Improvements](#limitations-and-future-improvements)
- [Technologies](#technologies)
- [How to Run](#how-to-run)
- [Lessons Learned](#lessons-learned)

## Objective

This project was developed with goal to finish the challenge from [Roadmap.sh](https://roadmap.sh/projects/github-user-activity) and practice:
- Structuring PHP applications using OOP
- Working with .JSON files
- Layered organization (CLI, Service, Repository)
- Integration with API using cURL
- Usage of Enums in PHP
- Handling command-line arguments
- Github's API

## Features
- ✅ User can enter username
- ✅ User can see last activity done by github account entered

## Technical Decisions

### Using Enums
At first I was using two arrays to create the binding between events and how I wanted to handle event names in my application, but I ended up having too many loops, so I decided to use an Enum with a match expression and a format method to handle the desired output using placeholders.

### Using cURL
There are other libs and ways to make an HTTP request, but the most common in PHP is cURL, so I decided to study and use it directly. I then abstracted cURL to make it easier to use throughout the application without having to manually initialize and close the stream every time.

### Layered Separation
The application was structured into the following layers:

- Core → Data input and output
- Service → External HTTP request and cache handle

```shell
github-user-activity/
├─ bin/
│  └─ github-activity.php
├─ src/
│  ├─ Services/
│  │  └─ GithubService.php
│  │  └─ CacheService.php
│  │  └─ CurlService.php
│  ├─ Core/
│  │  └─ Console.php
│  └─ Enums/
│  │  └─ GitHubEvents.php
└─ cache/
```

## Limitations and Future Improvements
During development, the biggest difficulty was working with Enums, as I wasn't used to how they work in PHP — it is quite different from Java and TypeScript.

In the future, it would be possible to improve how events are printed in the terminal and start using the full payload received from GitHub's API. However, since it was out of the project's scope, I decided not to, so I could move on to other projects sooner.

Besides that, I tried to use [pds/skeleton](https://github.com/php-pds/skeleton) as a base to structure the project, as you can see in `Core\Console`. I would have implemented my own take on it, but given the simple scope of the project I didn't — and the code was not copied as-is either.

Other possible improvements:

- Implementation of global error handling
- Creation of automated tests

## Technologies
- PHP 8+
- cURL 

## How to Run
On Windows, PHP must be installed with cURL enabled. Additionally, you need to configure the SSL CA Certificates to avoid certificate verification errors.

```bash
git clone https://github.com/Otavio-Cipriano/github-activity-cli.git
cd project /github-activity-cli
composer github-activity
```

### Usage

```bash
composer github-activity <github-username>
```

## Lessons Learned
- This was my first time using cURL with PHP. I had used it with Python some time ago, but back then I had no reason to configure SSL CA Certificates. At some point I started getting a lot of SSL errors and took a few minutes to understand why? after some research I discovered it was because the SSL CA Certificates were not configured.
- I learned a bit about the standards created by the PHP community, such as [pds/skeleton](https://github.com/php-pds/skeleton). It was really interesting. Now if I ever want to publish a package, I know how it should be structured.

## Author

Made by [@Otavio-Cipriano](https://github.com/Otavio-Cipriano) 🤖

<br/>
<br/>

<a href="https://www.linkedin.com/in/otaviocipriano/">
<img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" alt="linkedin"/>
</a>
<a href="https://twitter.com/otaviodv">
<img src="https://img.shields.io/badge/Twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white" alt="twitter"/>
</a>
