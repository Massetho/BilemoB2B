# BilemoB2B
REST API for Bilemo's products catalog

## Prerequisites
Environment :
  - PHP 7
  - MySQL 14.14

You must have installed the following before install :
  - [Git](https://git-scm.com/downloads)
  - [Composer](https://getcomposer.org/)

## Installing
Cloning the project repository :
```php
$ git clone https://github.com/Massetho/BilemoB2B
```

Edit `.env.dist` by adding your **admin mail** in the parameters. Then rename the file `.env`.

Getting all dependencies :
```php
$ composer install
```

Configure a *DATABASE_URL* constant, at the web server level, as explained [here](https://symfony.com/doc/current/configuration/external_parameters.html#configuring-environment-variables-in-production). Or edit the `.env` file and insert your database address :
```dotenv
DATABASE_URL=mysql://[db_user]:[password]@[IPaddress]:[port]/[db_name]
```

Generate your SSH key explained [here](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#installation).

Configure your **JWT_PASSPHRASE** constant in `.env`.

Set up your database :
```php
$ php bin/console make:migration
$ php bin/console doctrine:migrations:migrate
```

Loading fixture content : 
```php
$ php bin/console doctrine:fixtures:load
```

The default account have the following credentials :
  - **User** : "admin"
  - **Email** : the email address provided by you in the *ADMIN_MAIL* environment constant.
  - **Password** : "*pass1234*"

## Built with
  - [Symfony 4](https://symfony.com/) - PHP framework
  - [API Platform](https://api-platform.com/) - REST & GraphQL framework
  - [Composer](https://getcomposer.org/) - Dependency management

## Author
  **Quentin Thomasset** - PHP developper