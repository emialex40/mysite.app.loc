<?php

namespace App\Router;

class Route {

	private $uri;

	private $method;

	private $action;

	public function __construct ( string $uri, string $method, $action ) {
		$this->uri    = $uri;
		$this->method = $method;
		$this->action = $action;
	}

	public static function get(string $uri, $action): static
	{
		return new static ($uri, 'GET', $action);
	}

	public static function post(string $uri, $action): static
	{
		return new static ($uri, 'POST', $action);
	}

	public function getUri(): string
	{
		return $this->uri;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	/**
	 * @return callable
	 */
	public function getAction ()
	{
		return $this->action;
	}

}