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

	public function uri(): string
	{
		return trim(strtok($this->server['REQUEST_URI'], '?'), '/');
	}

	public function method(): string
	{
		return $this->server['REQUEST_METHOD'];
	}

	public function getAcceptableContentTypes() : array
	{
		return explode(',', $this->server['HTTP_ACCEPT']);
	}

	/**
	 * Determine if the current request is asking for JSON in return.
	 *
	 * @return bool
	 */
	public function wantsJson(): bool
	{
		$acceptable = $this->getAcceptableContentTypes();
	    return isset($acceptable[0]) && $acceptable[0] == 'application/json';
	}

	/**
	 * Determines whether the current requests accepts a given content type.
	 *
	 * @param  string|array  $contentTypes
	 * @return bool
	 */
	public function accepts($contentTypes)
	{
	    $accepts = $this->getAcceptableContentTypes();
	    if (count($accepts) === 0) {
	        return true;
	    }
	    $types = (array) $contentTypes;
	    foreach ($accepts as $accept) {
	        if ($accept === '*/*' || $accept === '*') {
	            return true;
	        }
	        foreach ($types as $type) {
	            if ($this->matchesType($accept, $type) || $accept === strtok($type, '/').'/*') {
	                return true;
	            }
	        }
	    }
	    return false;
	}

	/**
	 * Determine if the given content types match.
	 *
	 * @param  string  $actual
	 * @param  string  $type
	 * @return bool
	 */
	public static function matchesType($actual, $type)
	{
	    if ($actual === $type) {
	        return true;
	    }
	    $split = explode('/', $actual);
	    return isset($split[1]) && preg_match('#'.preg_quote($split[0], '#').'/.+\+'.preg_quote($split[1], '#').'#', $type);
	}

	/**
	 * Determines whether a request accepts JSON.
	 *
	 * @return bool
	 */
	public function acceptsJson()
	{
	    return $this->accepts('application/json');
	}
	/**
	 * Determines whether a request accepts HTML.
	 *
	 * @return bool
	 */
	public function acceptsHtml()
	{
	    return $this->accepts('text/html');
	}

	/**
	 * @see https://davidwalsh.name/detect-ajax
	 * @return bool
	 */
	public function ajax()
	{
		return !empty($this->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->server['HTTP_X_REQUESTED_WITH'])=== 'xmlhttprequest';
	}

	/**
	 * Get the bearer token from the request headers.
	 *
	 * @return string|null
	 */
	public function bearerToken()
	{
	    $header = $this->getAuthorizationHeader();
	    if (strpos($header, 'Bearer ') !== false) {
	        return substr($header, 7);
	    }
	}

	/**
	 * @see https://stackoverflow.com/questions/40582161/how-to-properly-use-bearer-tokens
	 * @return string|null
	 */
	public function getAuthorizationHeader()
	{
        if (isset($this->server['Authorization'])) {
            return trim($this->server["Authorization"]);
        }
        if (isset($this->server['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            return trim($this->server["HTTP_AUTHORIZATION"]);
        }
        if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                return trim($requestHeaders['Authorization']);
            }
        }
    }
}