# Test 3: PHP:

## Candidate Details:
 - Christiaan Visagie
 - visagiechristiaan40@gmail.com
 - Completed on 19/07/2023
 - Repo: [Click Here](https://github.com/theoriginalvisagie/devtest)

## Mission Statment:
Build a table using `php` and `MySQL`. Data located in `devt4est.sql`

## Folder Structure:

 - `index.php` -> Main HTML page.
 - `config.php` -> Configuration for database and url routing.
 - `admin/libraries/db.php` -> Databse connection and data retrieval.
 - `admin/modules/Data/Data_class.php` -> Main Data class containing functionality of project.
 - `admin/style/style.php` -> Main Style for project
 - `docker` -> Docker container config
 - `Entity Diagrams` -> Entity Relation diagrams of databse
 - `.htacess` -> Project restrictions

## Project Setup:

### Docker:
1. Copy folders inside the `docker` folder to a folder on your comupter called `dev-server`
2. Open a terminal inside the `dev-server` folder and run the following command:
```
docker compose up -d
```
3. Navigate to `http://localhost/devtest/phpTest/index.php` to the see output of the project.

### XAMPP:
1. Copy project into a folder called `devtest` inside your `htdocs` folder.
2. Open the project with an IDE and go to the `config.php` file.
3. Change the line that has:
```php
define("DB_HOST", "db");
```
to:
```php
define("DB_HOST", "localhost");
```
4. Navigate to `http://localhost/devtest/phpTest/index.php` to the see output of the project.

