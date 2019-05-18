# Collections management tool

Collection management tool APIs + admin

## Requirements

* PHP >= 7.1 + extensions:
    * ctype
    * curl
    * iconv
    * json
    * mysql
    * pdo
    * xml
    * zip
* Make
* OpenSSL
* Optional (for dev env):
    * Docker
    * Docker-compose
    
## Framework

Symfony 4.2 - webkit

## Libraries

## Symfony bundles

## External Bundles
* Doctrine
* Twig

## Dev bundles
* Deployer
* DoctrineFixtures
* GrumPHP
* PHP CS Fixer
* PHPStan
* PHPUnit

## Contributions

Before all working on the project, please read and respect the [coding conventions](CONVENTIONS.md).

## Install
### Clone the project

Firstable, you need to clone the project on your computer with 

    git clone 

### With Docker

You can override the docker-compose configuration with your own by renaming docker-compose.override.yml.dist by docker-compose.override.yml
and put your own ports and ip addresses to be used by docker.

#### Build images

    cd your/project/root
    make build
    
#### Run images

    cd your/project/root
    make up
    
#### Stop images

    cd your/project/root
    make down
    
#### Reload images

    cd your/project/root
    make reload
    
#### Use console in image
    
    docker ps
    
It returns:  
    
    CONTAINER ID        IMAGE                   COMMAND                  CREATED             STATUS              PORTS                                NAMES
    909421ecf6b5        nginx                   "nginx"                  12 seconds ago      Up 10 seconds       443/tcp, 0.0.0.0:8080->80/tcp        nginx_1
    04e7d84fd3a8        php                     "docker-php-entrypoi…"   13 seconds ago      Up 11 seconds       0.0.0.0:9000->9000/tcp               php_1
    ee6967df7afb        mysql:5.7               "docker-entrypoint.s…"   14 seconds ago      Up 12 seconds       33060/tcp, 0.0.0.0:13306->3306/tcp   db_1

Then, in this example, to use project's console:

    docker exec -ti 04e /bin/bash

### Without Docker
Type: 

    make install

## Use

In your browser, go to path_to_local_project/public/ or set a virtual host.
