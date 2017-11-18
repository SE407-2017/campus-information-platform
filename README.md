# Campus-Information-Platform
##
![](https://img.shields.io/badge/build-passing-brightgreen.svg)
![](https://img.shields.io/badge/licence-Apache%202-blue.svg)
![](https://img.shields.io/badge/Powered%20by-Laravel-green.svg)

## Requirements

* PHP >= 5.5.9
* Composer
* Mysql
* Npm

## Installation

	git clone https://github.com/SE407-2017/campus-information-platform
	# front-end dependencies
	cd frontend 
	npm install
	# back-end dependencies
	cd backend
	composer install
	php artisan key:generate(rename .env.example to .env) 
	
## Quick Start

	cd frontend
	npm run dev
	cd backend
	php -S 127.0.0.1:port
	
## Custom

	# Configure database
	vim backend/config/database.php

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=your database
	DB_USERNAME=root
	DB_PASSWORD=your password