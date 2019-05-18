.PHONY: deploy help install test
.PHONY: build down reload up
.DEFAULT_GOAL= help

BRANCH?= dev
CONSOLE?= bin/console
DEPLOYER?= bin/dep
ENV?= dev
PHPUNIT?= bin/phpunit

# Docker
DOCKER_COMPOSE?= docker-compose

#
# NO DOCKER
#
deploy: composer.lock ## Deploy dev
	php $(DEPLOYER) deploy $(ENV) --branch=$(BRANCH) -v

help: ## Help for make (you're in now)
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-10s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

install: vendor ## Install the project
	php $(CONSOLE) doctrine:database:create --if-not-exists
	php $(CONSOLE) doctrine:schema:update --force
	php $(CONSOLE) doctrine:fixtures:load --no-interaction
	mkdir var/data
	touch var/data/data.sqlite

test: vendor ## Launch tests
	php $(PHPUNIT) --stop-on-failure

vendor: composer.json
	composer install

#
# DOCKER
#
build: ## Build the images
	$(DOCKER_COMPOSE) build

down: ## Down the images
	$(DOCKER_COMPOSE) down

reload: down up ## Reload the images

up: ## Up the images
	@echo "\033[0;33m"
	@echo "   ____ __  __ _____   ______   ____  __ _____ ___  _   ___   __"
	@echo "  / ___|  \/  |_   _| / ___\ \ / /  \/  |  ___/ _ \| \ | \ \ / /"
	@echo " | |   | |\/| | | |   \___  \ V /| |\/| | |_ | | | |  \| |\ V / "
	@echo " | |___| |  | | | |    ___) || | | |  | |  _|| |_| | |\  | | |  "
	@echo "  \____|_|  |_| |_|   |____/ |_| |_|  |_|_|   \___/|_| \_| |_|  "
	@echo "\033[0m"
	$(DOCKER_COMPOSE) up -d --remove-orphans
