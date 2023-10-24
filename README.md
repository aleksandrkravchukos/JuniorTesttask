<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



# Docker / PHP 8.1 console/ Apache2 / Mysql 8 / npm / composer / laravel 10 / Laravel Mix v6.0.49

Docker project for console php 8.1 projects with composer.
Created from skeleton laravel 10.

## Prerequisites

Install Docker and optionally Make utility.

Commands from Makefile could be executed manually in case Make utility is not installed.
All command you can see in Makefile

## 1. Build container.

    Make build

## 2. Run docker containers

    Make up

## 3. Check docker containers

    Make check

## 4. Install the composer dependencies

    Make vendors-install

## 5. Install the npm dependencies.

    Make npm-install

## 7. Migrate

    Make migrate