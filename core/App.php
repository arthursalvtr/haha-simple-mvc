<?php

namespace Core;

/**
 * App
 */
class App
{
	protected $context = [];
	protected static $instance;

	public static function getInstance()
	{
		if (! static::$instance) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	public static function bind($key, $value)
	{
		if ($value instanceof \Closure) {
			$value = $value();
		}
		static::getInstance()->context[$key] = $value;
	}

	public static function resolve($key)
	{
		// if (! array_key_exists($key, static::getInstance()->context)) {
		// 	throw new \Exception("$key does not exists in App");
		// }
		return static::getInstance()->context[$key] ?? null;
	}

	public static function build($className) 
	{
        try {
            $reflector = new \ReflectionClass($className);
            if ($reflector->isInterface() && app($reflector->getName())) {
                return app($reflector->getName());
            }
            if ($reflector->isInterface()) {
                throw new \Exception("Interface {$reflector->getName()} is not registered within app");
            }
            $constructor = $reflector->getConstructor();
            if (! $constructor || ! $constructor->getParameters()) {
                return $reflector->newInstanceArgs();
            }
            foreach ($constructor->getParameters() as $dependency) {
                $instances[] = app($dependency->getName()) ? app($dependency->getName()) : static::build($dependency->getClass()->name);
            }

            return $reflector->newInstanceArgs($instances);
        } catch (\ReflectionException $e) {
            dd($e);
        } catch (\Exception $e) {
            dd($e);
        }
	}
}