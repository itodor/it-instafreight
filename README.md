# InstaFreight Demo Challenge

Coding challenge submission for InstaFreight.

## Description

Implement REST API with shipments endpoint that can be filtered by companies, carriers and/or addresses.

## Getting Started

### Dependencies

* Docker 20+
* Docker Compose

### Installing
Copy Laravel's `.env` file that was provided to you into `src` folder.

Position yourself into `src` directory and build containers/boot up your environment with:

* `cd src`
* `docker-compose up -d`

For the first time set-up you have to run migrations and seed files by executing following command (might take 1-2 min):
* `docker exec -it api php artisan migrate --seed`

To test that everything is working properly you should be able to go to: `localhost:8000` or make a test request for API to `localhost:8000/api/shipments`.

## Regular workflow:
For starting up your environment use:
* `docker-compose up -d`

Tearing down the environment:
* `docker-compose down`

## Check it out in production:
[/api/shipments](https://ivan-todorovic.com/api/shipments)

## Test the API:
Go to [swagger editor](https://editor.swagger.io) and paste the src/swagger.json to the editor.

## Stack information:
* `NGINX 1.22.0`
* `PHP 8.1`
* `PostgreSQL 14.4`
* `Lumen 9 (Laravel 9)`
* `Travis CI`

## Author

[Ivan Todorovic](https://github.com/itodor)

ivan.todorovic17@gmail.com

## Version History

* 0.1
  * Initial Release
