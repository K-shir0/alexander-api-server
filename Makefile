MARIADB_DATABASE=alexander
MARIADB_USER=alexander
MARIADB_PASSWORD=alexander-password
MARIADB_ROOT_PASSWORD=password

ARTISAN_CMD_PATH=artisan

.PHONY: run ps up down down-clean reset-db init install mariadb redis-cli

run:
	php ${ARTISAN_CMD_PATH} serve

run-docker:
	docker compose exec laravel php ${ARTISAN_CMD_PATH} serve --host 0.0.0.0

run-docker-echo:
	docker compose exec echo laravel-echo-server start

ps:
	docker compose ps

up:
	docker compose up -d

down:
	docker compose down

down-clean:
	docker compose down --rmi all

reset-db:
	docker compose exec laravel php ${ARTISAN_CMD_PATH} migrate:fresh --seed

init:
	php ${ARTISAN_CMD_PATH} key:generate

install:
	docker compose exec laravel composer install

# mariadb
mariadb:
	docker compose exec mariadb mysql -u $(MARIADB_USER) --password=$(MARIADB_PASSWORD) $(MARIADB_DATABASE)

# redis
redis-cli:
	docker compose exec redis redis-cli
