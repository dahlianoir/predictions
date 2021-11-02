# predictions api

## prerequisites
* Docker must be installed on local machine
* Docker daemon must be running

## running locally
[Laravel Sail](https://laravel.com/docs/8.x/sail) was used to create local env.

### first time run
When running for the first time, cd into the root directory and:

1. acquire dependencies (see Laravel Sail [documentation](https://laravel.com/docs/8.x/sail#installing-composer-dependencies-for-existing-projects) for details)
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
2. create .env file
```
cp .env.example .env
```
3. run Sail
```
./vendor/bin/sail up
```
4. generate app key
```
docker exec -it predictions_laravel.test_1 sh -c "php artisan key:generate --ansi"
```

The app is then available at http://localhost

### subsequent runs 
 In order to run the app, just cd into the root directory and run 
```
./vendor/bin/sail up
```

To stop, run
```
./vendor/bin/sail stop
```

## api documentation
Postman collection can be found in the **docs** directory

## inspections
CodeSniffer rules are defined in **phpcs.xml**. To run the inspections, use the following command:

```
docker exec -it predictions_laravel.test_1 sh -c "./vendor/bin/phpcs"
```

## tests
To run PhpUnit tests, use the following command:

```
docker exec -it predictions_laravel.test_1 sh -c "./vendor/bin/phpunit"
```
