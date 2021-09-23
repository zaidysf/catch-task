# CATCH TASK

Catch Task is an application that focusing on exporting json from API to a CSV File that will be validated by csvlint.io.
This applications are built for [catch.com.au](https://catch.com.au).

## Console Version

![console](https://raw.githubusercontent.com/zaidysf/catch-task/main/public/console-ss.png)

## Web Version

![web](https://raw.githubusercontent.com/zaidysf/catch-task/main/public/web-ss.png)

# Table of Content
- [Introduction](#introduction)
- [Installation](#installation)
- [Basic Usage](#basic-usage)
- [Testing](#testing)
- [Third Party](#third-party)

## Requirements

* PHP `>= 7.3`

* PhpSpreadsheet: `^1.15`

* PHP extension `php_zip` enabled

* PHP extension `php_xml` enabled

* PHP extension `php_gd2` enabled

* PHP extension `php_iconv` enabled

* PHP extension `php_simplexml` enabled

* PHP extension `php_xmlreader` enabled

* PHP extension `php_zlib` enabled

* [Composer](https://getcomposer.org/)

* [Redis Server](https://redis.io/)

* MySQL/MariaDB

## Introduction

Catch task has 2 ways to access

* via Console

    In console, we can access it directly via terminal, we can see list of commands by using below command
    ```
    php artisan list
    ```
    and see at `order` part

* via Web

    In web, we can access it via our favorite browser. By default, default host will show us the list of exported order

## Installation

* Clone this repository

* Copy .env.example to `.env.testing` and `.env`

* Change values of our `.env.testing` and `.env` as necessary
(like redis, db and order source file)

* Start our Redis Server

* Start our MySQL/MariaDB Server

* Run this command to install dependencies, generate key for laravel and do database migration
    ```
    composer install && php artisan key:generate && php artisan migrate
    ```

* Run the queue worker and let it run by separated terminal tab
    ```
    php artisan queue:work
    ```

* Serve the application by using our own webserver or run below command
    ```
    php artisan serve
    ```

* Access the applications
    ```
    // endpoint for download the json file in background and export it to csv
    - {HOST}/export

    // since this app using queue feature (using redis as the driver), you can see list of queue here
    - {HOST}/
    ```

## Basic Usage

Before do anything below, please ensure that you have set `ORDER_EXPORT_SOURCE_FILE` in your `.env` file correctly.

* Console

Open our terminal and run one of below commands

 Commands                            | Parameter Description       
:------------------------------------|:----------------------------
 php artisan order:export            |                             
 php artisan order:csv-validate {id} | Get the{id} from order:list 
 php artisan order:list              |                             

* Web

Open our web browser and access one of below links

 Links         | Description                    
:--------------|:------------------------------
 {host}/       | To show list of exported order 
 {host}/export | To export json to csv          

## Testing

* For testing, you can run below command
    ```
    php artisan test
    ```

## Third-party

* Laravel Excel

* CSVLint

* GuzzleHttp


## Author

[Zaid Yasyaf](https://www.linkedin.com/in/zaidysf/) :email: [Email Me](mailto:zaid.ug@gmail.com)
