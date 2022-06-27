# InstaFreight Demo Challenge

Coding challenge submission for InstaFreight.

## Description

Implement REST API with shipments endpoint that can be filtered by companies, carriers and/or addresses.

## Getting Started

### Dependencies

* Docker
* Docker Compose

### Installing
Copy Laravel's `.env` file that was provided to you into `src` folder.

Position yourself into `src` directory and build containers/boot up your environment with:

* `cd src`
* `docker-compose up`

(alternatively if you do not want to be in `src` directory you can provide a path to `.env` file with the flag `--env-file`)

* `docker-compose --env-file ./src/.env up`

For the firsst time set-up you have to run migrations and seeding files by executing following commands (DB seed might take 1-2 min):

* `docker exec -it api php artisan migrate`
* `docker exec -it api php artisan db:seed`

To test that everything is working properly you should be able to go to: `localhost:8000` or make a test request for API to `localhost:8000/api/shipments`.

## Regular workflow:
For starting up your environment use:
* `docker-compose up`

Or if you want to rebuild images you can use `--build` flag:
* `docker-compose up --build`

You can also use `-d` flag to run it as daemon and omit all the logs:
* `docker-compose up -d`

Tearing down the environment:
* `docker-compose down`

## Author

[Ivan Todorovic](https://github.com/itodor)

ivan.todorovic17@gmail.com

## Version History

* 0.1
    * Initial Release
