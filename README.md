
## WebSubscribe

A simple laravel subscription platform(only RESTful APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)


## How to install

Just clone or download the project and then run 
<code>composer install</code> 

to install all dependencies

Setup your DB config in your .env file

## DB Migration

<code>php artisan migrate</code>

## DB Seeding

<code>php artisan db:seed</code>

## Run the app
<code>php artisan serve</code>
