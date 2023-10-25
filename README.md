<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



# Docker / PHP 8.1 console/ Apache2 / Mysql 8 / composer / laravel 10

Docker project for console php 8.1 projects with composer.
Created from skeleton laravel 10.

## Prerequisites

Install Docker.

## Install.

    docker-compose up --build -d
    docker exec -it octarine_app composer install 
    cp .env.example .env 

## routes 

Route::post('/generate', 'RandomNumberController@generate');

Route::get('/retrieve/{id}', 'RandomNumberController@retrieve');

##POSTMAN EXAMPLE RESULT

http://joxi.ru/823LVqECwEgv4A


    