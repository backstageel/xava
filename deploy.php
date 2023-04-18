<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config
set('application', 'intranet');
set('repository', 'https://git@github.com/backstageel/xava.git');
set('keep_releases', 3);

// Shared files/dirs between deploys
add('shared_files', [
    '.env',
    'public/.user.ini',
]);
add('shared_dirs', [
    'storage',
    'bootstrap/cache',
]);

// Writable dirs by web server
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
]);

// Hosts

host('intranet.xava.co.mz')
    ->set('remote_user', 'root')
    ->set('writable_use_sudo', true)
    ->set('deploy_path', '/var/www/{{application}}');


desc('Runs the database migrations');

// Hooks

after('deploy:failed', 'deploy:unlock');
