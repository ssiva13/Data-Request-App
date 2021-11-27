# A Simple Data Access Request Application.
The applications basic functionalities include:
 - Allows users request access to data repos
 - Review of raised requests with comments
 - Approvals and denials of requests
 - Mailing/Notifications to requesters on their request status
 - Addition of third parties with access to the data


Architecture
------------
It has been in developed in the Yii2 Framework, documentation is at [docs/guide/README.md](https://github.com/yiisoft/yii2/blob/master/docs/guide/README.md)

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

Directory Structure
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



Requirements
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------

 1. Clone the repository
 2. Install dependencies via composer
      ```
         composer install 
      ```
    or
      ```
         composer update 
      ```
 3. Create the `.env` file and add the environment configurations from the `.env-sample` file.
 4. Create a `db.php` file to load the config defined in env with env variables.
    ```
    'dsn' => env('SAMPLE_DB_CONNECTION'). ':host=' .env('SAMPLE_DB_HOST'). ';dbname=' .env('SAMPLE_DB_DATABASE'),
    'username' => env('SAMPLE_DB_USERNAME'),
    'password' => env('SAMPLE_DB_PASSWORD'),
    'tablePrefix' => env('SAMPLE_DB_PREFIX'),
    ```
 5. Create a yii2 `web.php` file to load the config defined in env and set mail configs
     ```
     'host' => env('SAMPLE_MAIL_HOST'),
     'username' => env('SAMPLE_MAIL_USERNAME'),
     'password' => env('SAMPLE_MAIL_PASSWORD'),
     'port' => env('SAMPLE_MAIL_PORT'),
    ```
 6. Create a `params.php` file to load the config defined in env and set mail configs
     ```
    'adminEmail' => env('SAMPLE_ADMIN_EMAIL'),
    'senderEmail' => env('SAMPLE_SENDER_EMAIL'),
    'senderName' => env('SAMPLE_SENDER_NAME'),
    ```
 7. Add other basic yii2 config files
 8. Run migrations
 9. Execute `database/init.sql` in the database.
 10. Serve your application