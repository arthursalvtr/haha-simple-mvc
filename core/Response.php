<?php

namespace Core;

/**
 * 		
 */
class Response
{
	public function json ($array = [])
	{
		header('Content-Type: application/json');
		echo json_encode($array);
		exit();
	}
}