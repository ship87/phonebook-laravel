#!/usr/bin/env bash

docker stop phonebook_mysql phonebook_nginx phonebook_app
docker rm phonebook_mysql phonebook_nginx phonebook_app
docker rmi phonebook_mysql phonebook_app
