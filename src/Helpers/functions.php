<?php

use Core\App;

function dd()
{
	echo '<pre>';
	echo debug_print_backtrace();
	echo '</pre>';
	foreach (func_get_args() as $key => $value) {
		echo '<pre>';
		var_dump($value);
		echo '</pre>';
	}
	die();
}

function config($key)
{
	$config = require_once APP_ROOT.'./config.php';
	return $config[$key] ?? null;
}

function view($file, $data = [])
{
	extract($data);
	return require APP_ROOT.'/views/'.$file.'.haha.php';
}

function app($key)
{
	return App::resolve($key);
}