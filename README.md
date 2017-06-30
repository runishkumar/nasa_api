nasa_api
========

A Symfony project created on June 27, 2017, 7:02 pm.

Setup instruction
=================

- Clone repository
- Run `composer install`
- Add app/config/parameters.yml but copying it from app/config/parameters.yml.dist
- Add database configs and api key for nasa api
- Run `php bin/console doctrine:database:create` to create the configured database
- Run `php bin/console doctrine:migrations:migrate` to run the migrations
- Run `php bin/console nasa:fetch-neos` to fetch the neos data from last 3 days

And, that's it. You are ready to go.
