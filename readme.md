# tool-agile-team

Agile development tool focused on product quality, user experience and bringing benefits and transparency to your development team.

## Installation

In order to get ready, clone the repo and install all the dependencies:

```
composer install
```

Generate a new .env file:

```
cp .env.example .env
```

And set the database conection variables.

Generate your app key:

```
php artisan key:generate
```

Setup the database:

```
php artisan migrate
php artisan db:seed
```

Then you're ready to go:

```
php artisan serve
```

## Contributions

Feel free to send pull requests and suggestions
