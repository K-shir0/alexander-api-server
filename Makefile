MARIADB_DATABASE=alexander
MARIADB_USER=alexander
MARIADB_PASSWORD=alexander-password
MARIADB_ROOT_PASSWORD=password

ARTISAN_CMD_PATH=artisan

.PHONY: run ps up down reset-db init mariadb

run:
	php ${ARTISAN_CMD_PATH} serve

run-docker:
	docker compose exec laravel php ${ARTISAN_CMD_PATH} serve --host 0.0.0.0

ps:
	docker compose ps

up:
	docker compose up -d

down:
	docker compose down

reset-db:
	php ${ARTISAN_CMD_PATH} migrate:fresh --seed

init:
	php ${ARTISAN_CMD_PATH} key:generate

# mariadb
mariadb:
	docker compose exec mariadb mysql -u $(MARIADB_USER) --password=$(MARIADB_PASSWORD) $(MARIADB_DATABASE)
