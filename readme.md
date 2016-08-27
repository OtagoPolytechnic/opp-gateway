# OPP Gateway

## Install

1. Clone repo
2. Install composer dependencies `composer install`
3. Setup the enviroment variables: copy `.env.example` to `.env` and fill in the blanks.
4. Generate a key `artisan key:generate`
5. Seed the database `artisan migrate --seed`
6. Install node dependencies `npm install`
7. Compile React & SCSS `gulp`


## Requirements

1. [Composer](https://getcomposer.org/download/)
2. [npm](https://docs.npmjs.com/getting-started/installing-node)

## Tests

Every model method and every API route needs tests.

Run tests with `phpunit`
