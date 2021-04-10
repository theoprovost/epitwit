<br>
<p align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="utils/twit.svg" alt="Epitwit logo" width="100" height="100" style="filter: invert(54%) sepia(63%) saturate(1131%) hue-rotate(174deg) brightness(88%) contrast(87%);">
  </a>

  <h3 align="center">Epitwit.tech</h3>

  <p align="center">
    Real-time twitter like application
    <br />
    <a href="https://epitwit.tech/">View Demo</a>
    ·
    <a href="https://github.com/theoprovost/epitwit/issues">Report Bug</a>
  </p>
</p>
<br>

<p>🏗 Work in porgress, this version is a draft.</p>
<br>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#">Abstract</a></li>
        <li><a href="#">Notable features</a></li>
        <li><a href="#">Built with</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

## About the project
### Abstract
This project was made for an assignment from Epitech. The idea was to recreate the most common and basic features of Twitter.

### Notable features
- Secured register and login
- Real-time
  - timeline
  - messaging service
  - notifications
- Update profile
- Follow people/be followed back
- Character limited tweet
- Attach photographs to tweets
- Tweet, like, retweet, retweet with quote
- Mentions and hashtags
- Search bar for user/hashtags

### Built with
|Backend|Frontend|Data|Real-time|
|---|---|---|---|
|PHP|VueJs|MySQL|Laravel Echo
|Laravel|Sass||Pusher

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
```
cd <project_folder>
mysql -u root -p < ./utils/create_database.sql
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
Finally you can launch the project.  🚀
```
php artisan key:generate
sudo php artisan serve --host=127.0.0.1 --port=80
php artisan websockets:serve
npm run dev
```

## Contact
This project was made possible thanks to Alexis, my project's partner. <br>
> Théo Provost @theoprovost - theo.provost@epitech.eu <br>
> Alexis Dandres @\[to-fill] - \[to-fill]
