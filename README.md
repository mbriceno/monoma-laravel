This porject was developed with:

* Laravel 10.x
* Composer 2.7.x
* PHP 8.3.x
* Mysql 8.4
* Redis 7.2.x
* Nginx

The project run over docker containers and is orchestrated with docker compose:

To build and run the containers call docker compose:

```sh
docker compose up --build
```

To run the test suite:

```sh
docker compose run --rm artisan test
```

To check standar code with php-fixer run:

```sh
docker compose run --rm composer phpcs
```

Current endpoints:

```sh
  POST       api/auth
  POST       api/logout 
  POST       api/me 
  POST       api/refresh

  POST       api/lead 
  GET|HEAD   api/lead/{id} 
  GET|HEAD   api/leads 
  GET|HEAD   api/user
```
