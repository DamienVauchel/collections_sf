<?php

namespace Deployer;

use Symfony\Component\Dotenv\Dotenv;

require 'recipe/symfony4.php';

set('application', 'Collections Management Tool (BO and APIs)');
set('repository', 'git@github.com:DamienVauchel/collections_sf.git');

set('git_tty', true);

add('shared_files', []);
add('shared_dirs', [
    'config/jwt',
]);

add('writable_dirs', []);
set('allow_anonymous_stats', false);

set('default_stage', 'dev');

// Dev
host('dev')
    ->hostname('')
    ->set('deploy_path', '/var/www/collections_sf_dev')
    ->user('ylly')
    ->set('bin/php', '/usr/bin/php7.3');

task('build', function () {
    run('cd {{release_path}} && build');
});

task('load:env-vars', function () {
    $dotenv = new Dotenv();
    $new_variables = run('cat {{current_path}}/.env.dist');
    $old_enviroment = run('cat {{deploy_path}}/shared/.env');
    $environment = array_merge($dotenv->parse($new_variables), $dotenv->parse($old_enviroment), get('env'));
    $dotenv->populate($environment);
    set('env', $environment);

    $loadedVars = array_flip(explode(',', getenv('SYMFONY_DOTENV_VARS')));
    unset($loadedVars['']);
    $loadedVars = array_flip($loadedVars);
    $first = true;
    foreach ($loadedVars as $loadedVar) {
        if ($first) {
            run('echo "'.$loadedVar.'='.$environment[$loadedVar].'" > {{deploy_path}}/shared/.env');
            $first = false;
        } elseif ('GIT_VERSION' === $loadedVar) {
            run('echo "'.$loadedVar.'={{branch}}" >> {{deploy_path}}/shared/.env');
        } else {
            run('echo "'.$loadedVar.'='.$environment[$loadedVar].'" >> {{deploy_path}}/shared/.env');
        }
    }
});

before('deploy:shared', 'load:env-vars');
after('deploy:failed', 'deploy:unlock');
before('deploy:symlink', 'database:migrate');
