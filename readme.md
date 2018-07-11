## About MyBlog

MyBlog is Laravel based web application/CMS with some minor blogging features new features comming soon


## Installation

To Install this project check out this repo

Create a mysql database for example `myblog`

## Set up dependencies

`composer install`

`npm install`

## Set up Files/Images dir via symbolic link

Laravel stores images in storage/app/public folder but that is not accessible from browser so we will have to create symlink and this directory will be created after creating symlink public/storage using this command

`php artisan storage:link` 

## Set up migrations

`php artisan migrate:refresh --seed`

and done!

First admin user is automatically create you can login user these credentials
`email : admin@gmail.com,password : admin`