<?php
namespace App\Controller;

use App\Models\User;
use Core\Request;
use Core\Response;

/**
 * HelloController
 */
class HelloController
{
    /**
     * @return string
     */
    public function index(Request $request, Response $response)
	{
		return $response->json(['mesg' => 'adfadsf', 'token' => $request->bearerToken(), 'input' => $request->input('hi')]);
	}

	public function home()
	{
		return view('index');
	}

	public function api(Response $response)
	{
		return $response->json(['message' => 'Welcome']);
	}
}