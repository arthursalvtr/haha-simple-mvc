<?php

namespace Core;

use ReflectionMethod;
use ReflectionClass;

/**
 * Route
 */
class Route
{
	protected static $instance;
	protected $routes = [
		'GET' => [],
		'POST' => [],
		'PATCH' => [],
		'DELETE' => [],
	];
	protected $default_path = 'routes';
	protected $controller_namespace = '\App\Controller';

	public static function load($file)
	{
		$instance = static::getInstance();

		require APP_ROOT.'/'.$instance->default_path.'/'.$file;
		return $instance;
	}

	public function direct()
	{
		$method = app('request')->method();
		$uri = app('request')->uri();
		if (! array_key_exists($uri, $this->routes[$method])) {
			throw new \Exception("Method: {$method} for page {$uri} is not found!");
		}
		$control = explode('@', $this->routes[$method][$uri]);
		return $this->callAction($control[0], $control[1]);
	}

	protected function callAction($controller, $action)
	{
		$controller = $this->getController($controller);

		$reflection = new ReflectionMethod($controller, $action);
		$dependencies = [];
		foreach ($reflection->getParameters() as $dependency) {
			$class = $dependency->getClass();
			if ($class) {
				$dependencies[] = app($dependency->getName()) ? app($dependency->getName()) : App::build($class->name);
			}
		}
		$controller = new $controller;
		if (! method_exists($controller, $action)) {
			throw new \Exception("$action does not exist in ".get_class($controller));
		}
		return $reflection->invokeArgs($controller, $dependencies);
	} 

	public static function get($uri, $controller)
	{
		static::getInstance()->routes['GET'][$uri] = $controller;
	}

	public static function post($uri, $controller)
	{
		static::getInstance()->routes['POST'][$uri] = $controller;
	}

	public static function patch($uri, $controller)
	{
		static::getInstance()->routes['PATCH'][$uri] = $controller;
	}

	public static function delete($uri, $controller)
	{
		static::getInstance()->routes['DELETE'][$uri] = $controller;
	}

	public static function getInstance()
	{
		if (! static::$instance) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	protected function getController($controller): string
	{
		return $this->controller_namespace.'\\'.$controller;
	}

}