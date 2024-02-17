<h1 align="center">
--== IDPA Matches ==--
</h1> 



## Short description 

Public list of Major IDPA Matches available around the world 

Displayed by ReactJS / Backed by a Laravel REST API

Requirements
------------
- PHP ^8.1
- Git
- Docker
- Composer

Features
------------
- [Laravel](https://laravel.com/docs/10.x/installation) - PHP Framework
- [ReactJS](https://react.dev/) - React JS frontend framework
- [Sail](https://laravel.com/docs/10.x/sail) (Laravel Docker development environment)
- [Pint](https://laravel.com/docs/10.x/pint) PHP code style fixer (based on PHP-CS-Fixer)
- Swagger-PHP & Swagger-UI

Installation
------------
1. Clone the project locally and set it up, configuring .env file also:
```
git clone git@github.com:florinphp/idpamatches.git

cd idpamatches/

composer install

cp .env.example .env
```
3. Add `sail` command alias to your system (for **nix/MacOS**):
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
4. Start the local development environment and link the storage public folder:
```
sail up -d
sail artisan key:generate
sail artisan storage:link
```
5. Add the hosts files on your system, the following entry :
```
127.0.0.1 idpamatches.test
```
6. Access the project in the browser by typing `idpamatches.test`
7. Use `sail down` command to shut down the project.

PHPStorm linter (pint) settings
------------
Follow up on the [following instructions](https://www.jetbrains.com/help/phpstorm/using-laravel-pint.html) from JetBrains to setup pint in your PHPStorm.

OpenApi Documentation
------------
Run the following command to generate the API documentation:
```
sail artisan api:docs
```
then access it in the browser here http://idpamatches.test/api-docs

Testing
------------
There is a different DB configured for testing in `phpunit.xml`.
The API tests know to know the seeders before each test class,
but the DB requires migrations to be run against it. For this,
just change the DB name in `.env` file from "laravel" to "testing"
and run the migration with the command `sail artisan migrate`

To run the test just the following command

```
sail test
```
