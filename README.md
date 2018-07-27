# HAHA Simple MVC

A very simple laravel inspired MVC build after watching [Laracast](www.laracast.com)

## Instalation

Clone this repository

`git clone https://github.com/arthursalvtr/haha-simple-mvc.git`

run composer install, we don't have any dependencies yet at this moment

`composer install`

For Nginx:
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

For Apache, .htaccess
```
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```