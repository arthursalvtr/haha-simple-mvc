<?php

use Core\App;
use Core\Database\MySql;
use Core\Request;
use Core\Response;
use Core\Route;

App::bind('response', (new Response));
App::bind('request', function () {
	return new Request;
});
App::bind('mysql', function () {
    return new Mysql(
        config('destination.host'),
        config('destination.db'),
        config('destination.user'),
        config('destination.pwd')
    );
});
App::bind(\Core\Contracts\Database::class, App::resolve('mysql'));
Route::load('api.php');
Route::load('web.php')->direct();