# Projet Epitwit

// ABSTRACT

## Getting started

### Prerequisites
Before starting, make sure you have these following installed on your machine.
- Apache
- PHP8
- NPM
- Composer
- MySQL

### Installation
Clone the repo in the html folder of Apache.
```
cd [...]/html
git clone git@github.com:theoprovost/epitwit.git
```
Create a MySQL database.
```sql
cd <project_folder>
mysql -u root -p < create_database.sql
```
Then download dependencies from `package.json` and `composer.json`.
```
npm install && composer install
composer dump-autoload
```
Create a `.env` file based on the `.env.example` one with your credentials.
```
touch .env
nano .env
...
```
If everything is set up, you can now migrate the tables in your database.
```
php artisan migrate
```
Finally you can launch the project.
```
sudo php artisan serve --host=127.0.0.1 --port=80
php artisan websockets:serve
npm run dev
```
##