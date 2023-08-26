<!-- I am trying to build an opensource Learning Management System using the TALL stack can you generate an standard markdown for this
 -->

# Lara Learn

## About

Lara Learn is an open source Learning Management System built with the TALL stack. It is currently under development.

## Installation

1.  Clone the repository

    ```bash
    git clone
    ```

2.  Install composer dependencies

    ```bash
    composer install
    ```

3.  Install NPM dependencies

    ```bash
    npm install
    ```

4.  Create a copy of your .env file

    ```bash
    cp .env.example .env
    ```

5.  Generate an app encryption key

        ```bash
        php artisan key:generate
        ```

    Suggestion 1

6.  Create an empty database for our application

    ```bash
    touch database/database.sqlite
    ```

7.  Add database information to .env

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sq
```

8. Migrate the database

    ```bash
    php artisan migrate
    ```

9. Seed the database

    ```bash
    php artisan db:seed
    ```

10. Run the server

    ```bash
    php artisan serve
    ```

11. Go to localhost:8000/admin in your browser
