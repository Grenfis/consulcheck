include .env
export

.PHONY: up

docker := $(shell command -v docker 2> /dev/null)
docker_compose := $(shell command -v docker-compose -f docker-compose.yml -p se 2> /dev/null)
cli_container_name = $(PROJECT_NAME)-cli

build:
	$(docker_compose) down
	$(docker_compose) build

up:
	$(docker_compose) up -d

down:
	$(docker_compose) down

restart:
	$(docker_compose) down
	$(docker_compose) up -d

ps:
	$(docker_compose) ps

cli:
	$(docker) exec -it $(cli_container_name) bash

install:
	$(docker) exec $(cli_container_name) sh -c "composer install && composer  dump-autoload"

require:
	$(docker) exec $(cli_container_name) sh -c "composer require $(pkg) && composer  dump-autoload"

ph_create:
	$(docker) exec $(cli_container_name) sh -c "php vendor/bin/phinx create $(name)" &&  sudo chown -R snippy:snippy db/migrations/

ph_migrate:
	$(docker) exec $(cli_container_name) sh -c "php vendor/bin/phinx migrate -e production"