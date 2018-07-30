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
	$config = require APP_ROOT.'./config.php';
	$keys = explode('.', $key);
    foreach ($keys as $item) {
//        if (! is_array($config)) {
//
//            dd($config, $item, $keys);
//        }
        if (! array_key_exists($item, $config)) {
            return null;
        }
        $config = $config[$item];
	}
	return $config;
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

if (! function_exists('constring_maker')) {

    /**
     * Connection String maker
     * 连接数据库的字符
     * @example
     * $config = [
     *      'mysql:host' => 'YOUR_HOST_NAME',
     *      'dbname' => 'YOUR_DB_NAME',
     * ];
     * $connectionString = constring_maker($config);
     * @param array $config
     * @return string
     */
    function constring_maker($config)
    {
        $final = '';
        foreach ($config as $key => $item) {
            $final .= $key .'='.$item.';';
        }
        return $final;
    }
}