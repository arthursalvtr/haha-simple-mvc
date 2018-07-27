<?php

use Core\Route;

Route::get('', 'HelloController@index');
Route::get('/home', 'HelloController@home');