#!/usr/bin/env bash

docker-compose -p phonebook up -d

docker exec phonebook_app cp .env.example .env
docker exec phonebook_app composer install
docker exec phonebook_app php artisan key:generate
docker exec phonebook_app php artisan storage:link
