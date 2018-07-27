<?php

namespace Core;

/**
 * Request
 */
class Request
{
	protected $request;
	protected $server;

	public function __construct()
	{
		$this->request = $_REQUEST;
		$this->server = $_SERVER; //Global Variable 系统函数
	}

	public function input($key)
	{
		return $this->request[$key] ?? null;
	}

	public function uri()
	{
		return trim($this->server['REQUEST_URI'], '/');
	}

	public function method()
	{
		return $this->server['REQUEST_METHOD'];
	}
}