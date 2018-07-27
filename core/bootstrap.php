<?php

use Core\App;
use Core\Request;
use Core\Response;
use Core\Route;


App::bind('response', (new Response));
App::bind('request', function () {
	return new Request;
});
Route::load('api.php');
Route::load('web.php')->direct();