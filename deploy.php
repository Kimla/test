<?php

namespace Deployer;

require 'recipe/common.php';

$user = 't16090j';

// User
set('user', $user);

// Project name
set('application', 'foodhills_portal');

// Project repository
set('repository', 'git@bitbucket.org:bravissimo_agency/foodhills-portal.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

set('allow_anonymous_stats', false);
set('ssh_multiplexing', false);

set('project_path', "/home/{$user}/foodhills.se/www");

host('ssh.i8t.com')
    ->user($user);
/*
// init
*/

task('deploy_from_git', function () {
    $projectPath = get('project_path');

    run("
        cd {$projectPath};
        git pull;
        composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev;
        php artisan migrate --force;
        php artisan cache:clear;
        php artisan auth:clear-resets;
        php artisan route:cache;
        php artisan view:cache;
    ");
})->desc('Deploy from git');

task('deploy', [
    'deploy_from_git',
])->desc('Deploy from git');
