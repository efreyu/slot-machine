docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

composer-install:
	if [ ! -d "vendor" ]; then docker run --rm --interactive --tty --volume ${PWD}:/app composer install; fi

cp-env:
	if [ ! -f ".env" ]; then cp .env.example .env && docker-compose exec php-cli php artisan key:generate; fi

init:
	if [ ! -d "vendor" ] || [ ! -f ".env" ]; then \
	make docker-build; \
	else \
	make docker-up; \
	fi

migrate:
	docker-compose exec php-cli php artisan migrate

test:
	docker-compose exec php-cli vendor/bin/phpunit

perm:
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} storage -R
	if [ -d "node_modules" ]; then sudo chown ${USER}:${USER} node_modules -R; fi
	if [ -d "public/build" ]; then sudo chown ${USER}:${USER} public/build -R; fi

open:
	echo -e "\e[1;97;44mAll done! Now you can visit - https://localhost:8080/"

up: init composer-install cp-env migrate open

down: docker-down