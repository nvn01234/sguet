<p align="center"><a href="http://sguet.com/"><img src="http://sguet.com/sites/default/files/SGUET.png"></a></p>

<p align="center">
<a href="http://sguet.com/">Website</a> |
<a href="https://www.facebook.com/SupportGroupUET/">Fanpage</a> |
<a href="https://www.facebook.com/groups/sguet/">Group</a>
</p>

## About SGUET

> Deploy sguet.com website

## Version

Status: Developing

Start date: 10/01/2017

Submission date: --/01/2017

## Structure

Resource doc: /sguet-resource-doc

## Documents

Detailed guides in /sguet-resource-doc folder.

[Wire frame](https://docs.google.com/document/d/1y9t4rCHEjLX9YyTqoe1lS81bljDGS3qCd3NLwv76lfs/edit)

## Technology overview

Bootstrap

Jquery

Laravel 5

## Requirement system

PHP 7+

## Deployment

Step 1: Create database 'sguet'

Step 2: Config .env (see [.env.example](https://github.com/nvn01234/sguet/blob/master/.env.example))

- Config DB_*    

- Generate key:

        $ php artisan key:generate

Step 3: Install

        $ composer update
        $ composer install
        $ php artisan key:generate
        $ php artisan migrate --seed
        $ php artisan serve
        
- Open localhost:8000
    
## Development

Step 1: Install composer

        $ composer update
        $ composer install

Step 2: Database & migrations

- Create database 'sguet'

- Clone [.env.example](https://github.com/nvn01234/sguet/blob/master/.env.example) > .env

- Config .env: DB_*

- migrate & seed

        $ php artisan migrate --seed
        
- Generate ide-helper:

        $ php artisan ide-helper:generate
        $ php artisan ide-helper:models
            $ yes
        $ php artisan ide-helper:meta
        
Step 3: Configurations
  
        $ php artisan key:generate
    
Step 4: Serve
  
        $ php artisan serve

- Open localhost:8000
    
## Common problem

#### Cannot seed migrate

- edit '.env': set CACHE_DRIVER=array

- Run:

        $ php artisan config:cache
        $ composer dump-autoload
        $ php artisan migrate:refresh --seed
    
#### Form cannot post data

- Use {{Form::open(...)}} or {{Form::model(...)}} instead of form html tag 

- Or add {{Form::token()}} or {{csrf_token()}} in form body

(see [Forms & HTML](https://laravel.com/docs/4.2/html))
    
## PhpStorm plugin instructions

- Settings > Plugins > Browse repositories... > find 'Laravel' > Install

- Settings > Languages and Frameworks > Php > Laravel > Tick on 'Enable plugin for this project'
    
## Composer library

[composer.json](https://github.com/nvn01234/sguet/blob/master/composer.json)

        {
            "barryvdh/laravel-debugbar": "^2.3",  
            "barryvdh/laravel-ide-helper": "^2.2",
            "doctrine/dbal": "^2.5",
        }
    
## Developers

Nguyen Van Nhat - UET - nguyenvanhat152@gmail.com - +84.166.3077313
