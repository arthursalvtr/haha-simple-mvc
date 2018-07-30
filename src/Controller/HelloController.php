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
    public function index(Response $response, User $user)
	{
//	    $mysql = app('mysql');
//        $user = new User($mysql);
	    //	    $all = $mysql->select(['ajaja', 'ddddd', 'asdfaewrnm']);
        dd($user);
		return $response->json(['config' => config('source.db')]);
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