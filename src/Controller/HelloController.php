<?php
namespace App\Controller;

use App\Models\User;
use Core\Response;

/**
 * HelloController
 */
class HelloController
{
    /**
     * @return string
     */
    public function index()
	{
		
		return Response::json(['mesg' => 'adfadsf']);
	}

	public function home()
	{
		return view('index');
	}

	public function api()
	{
		return Response::json(['message' => 'Welcome']);
	}
}