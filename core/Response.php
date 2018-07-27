<?php

namespace Core;

/**
 * 		
 */
class Response
{
	public static function json ($array = [])
	{
		header('Content-Type: application/json');
		echo json_encode($array);
		exit();
	}
}