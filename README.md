# CATCH TASK

This applications are built for [catch.com.au](https://catch.com.au).

## Console Version

![console](https://raw.githubusercontent.com/zaidysf/catch-task/main/public/console-ss.png)

## Web Version

![web](https://raw.githubusercontent.com/zaidysf/catch-task/main/public/web-ss.png)

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

## Installation

* Clone this repository

* Copy .env.example to `.env.testing` and `.env`

* Change values of your `.env.testing` and `.env` as necessary
(like redis, db and order source file)

* Start your Redis Server

* Start your MySQL/MariaDB Server

* Run this command to install dependencies, generate key for laravel and do database migration
    ```
    composer install && php artisan key:generate && php artisan migrate
    ```

* Run the queue worker and let it run by separated terminal tab
    ```
    php artisan queue:work
    ```

* Serve the application by using your own webserver or run below command
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
