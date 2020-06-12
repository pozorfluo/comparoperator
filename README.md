# comparoperator

## installation

1. Clone this repository

    ```shell
    git clone --depth=1 https://github.com/pozorfluo/comparoperator.git
    ```

1. Setup

    ```shell
    cd scripts
    ./setup.sh
    ```

1. Setup the database with :

    ```
    resources/sql/comparoperator.sql
    ```

    ~~_( note : this will bootstrap the database with test data )_~~

1. In index.php, change DEV_FORCE_CONFIG_UPDATE to true
    ```php
    define('DEV_FORCE_CONFIG_UPDATE', true);
    ```
1. Navigate to index.php in your environment
    - A .env file is created with a skeleton config for this app.
    - Update the default db configuration in .env to match your environment.
      e.g.,
    ```json
      "db_configs": {
        "product_hunt": {
        "DB_DRIVER": "mysql",
        "DB_HOST": "127.0.0.1",
        "DB_PORT": "3306",
        "DB_CHARSET": "utf8mb4",
        "DB_NAME": "tp_product_hunt",
        "DB_USER": "your_user_name",
        "DB_PASSWORD": "your_db_password"
        }
    ```
1. Navigate to index.php

## build

1. Install dependencies

    ```shell
    cd
    npm i
    ```

1. Build sass and js

    ```shell
    npm run build
    ```

1. Start build in watch mode

    ```shell
    npm run watch
    ```

1. Stop build in watch mode

    ```shell
    npm run watch-stop
    ```

## tests

## docs

## app flowchart

## db

## wireframes

### desktop/laptop

![desktop](htdocs/resources/images/wireframe-desktop.png)

### tablet

![tablet](htdocs/resources/images/wireframe-tablet.png)

### mobile

![mobile](htdocs/resources/images/wireframe-mobile.png)

## todo

see [project board]()

## decisions log

-   Follow PSR-1 and PSR-12 coding standards.
-   Use github project board.

## reference links
