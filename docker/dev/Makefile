#!/usr/bin/make
# Makefile readme (ru): <http://linux.yaroslavl.ru/docs/prog/gnu_make_3-79_russian_manual.html>
# Makefile readme (en): <https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents>

SHELL = /bin/sh

IMAGES_PREFIX := $(shell basename $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST)))))

# Important: Local images naming should be in docker-compose naming style

APP_CONTAINER_NAME := app
NODE_CONTAINER_NAME := node
COMPOSER_CONTAINER_NAME := composer
PHP_CLI_CONTAINER_NAME := php

docker_bin := $(shell command -v docker 2> /dev/null)
docker_compose_bin := $(shell command -v docker-compose 2> /dev/null)

.PHONY : help up down \
		cli-php cli-composer cli-node \
		install install-front install-composer \
		build \
		dev

.DEFAULT_GOAL := help

# This will output the help for each task. thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
help: ## Show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# --- [ Containers management tasks ] ---------------------------------------------------------------------------------

up: ## Build frontend, init and up Application container with web-services
	$(docker_compose_bin) up -d

down: ## Stop all started for development containers
	$(docker_compose_bin) down

# --- [ Cli services ] ------------------------------------------------------------------------------------------------

cli-php: ## Start PHP shell for manual operations
	$(docker_compose_bin) -f ./docker-compose-build.yml run --rm "$(PHP_CLI_CONTAINER_NAME)" /bin/sh

cli-composer: ## Start Composer shell for manual operations
	$(docker_compose_bin) -f ./docker-compose-build.yml run --rm "$(COMPOSER_CONTAINER_NAME)" /bin/sh

cli-node: ## Start Node.js shell for manual operations
	$(docker_compose_bin) -f ./docker-compose-build.yml run --rm "$(NODE_CONTAINER_NAME)" /bin/sh

# --- [ Install] ------------------------------------------------------------------------------------------------------

install-composer: ## Install Composer deps
	$(docker_compose_bin) -f ./docker-compose-build.yml run --rm "$(COMPOSER_CONTAINER_NAME)" composer install --no-interaction --ansi --no-suggest

