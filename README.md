# Shoot it
"Shoot it" is a application to help pass theoretical exam for shooting patent. This application was made as engineering thesis

### Live Demo 
[Click here](https://shoot-it.cholipski.ovh)


### All Documentation

on branch [`DOCUMENTATION`](https://github.com/Cholipski/Shoot-it/tree/DOCUMENTATION)


This repository provides you a development environment without requiring you to install PHP, a web server, and any other server software on your local machine. For this, it requires Docker and Docker Compose.

## Installation

1. Install [docker](https://docs.docker.com/engine/installation/) and [docker-compose](https://docs.docker.com/compose/install/).

2. Copy `docker-compose.yml` file to your project root path, and edit it according to your needs.

3. From your project directory, start up your application by running:

```sh
docker-compose up
```
4. You can run `composer` or `npm` or `artisan` through docker. For instance:

```sh
docker-compose exec app composer install
docker-compose exec app php artisan migrate
docker-compose exec npm $yourCommandHere
```

## MySQL Configuration
This is a simple environment configuration I have provided in `docker-compose.yml` file:
```
environment:
      MYSQL_DATABASE: laravel
      MYSQL_ROOT_PASSWORD: password
```
But you can add more configurations to your MySQL by adding:
```
environment:
      MYSQL_DATABASE: 'laravel'
      MYSQL_USER: 'laravel-user'
      MYSQL_PASSWORD: 'laravel@123'
      MYSQL_ROOT_PASSWORD: 'root@123'
```
