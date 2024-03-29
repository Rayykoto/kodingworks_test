# Getting started

## Installation

Clone the repository

    git clone https://github.com/Rayykoto/kodingworks_test.git

Switch to the repo folder

    cd kodingworks_test

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/Rayykoto/kodingworks_test.git
    cd kodingworks_test
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:generate 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

## Documentaion Endpoint Postman
    Authentikasi: 
https://documenter.getpostman.com/view/17101573/2s9YXe8Q1M
   
    Crud Task Endpoint: 
https://documenter.getpostman.com/view/17101573/2s9YXe8Q1J

## Video Demo Task
Loom pertama:
https://www.loom.com/share/da4983c82f9e41f1b65b9b4d23bb2c10?sid=51251fba-55ed-4ee4-b4f4-00044f2e6d79
<br>
Loom kedua (revisi):
https://www.loom.com/share/1100e14cb2fc4ad18b04a763daf5e75e?sid=1c76607d-1201-40b7-9c99-8adf09be83a2

## Mulai Mengerjakan 3 November 2023, 01.00 PM.
