<?php

namespace App\Router;

class Router {

	private array $routes
		= [
			'GET'  => [],
			'POST' => [],
		];

	public function __construct () {
		$this->initRoute();
	}

	private function initRoute () {
		$routes = $this->getRoutes();

		foreach ( $routes as $route ) {
			$this->routes[ $route->getMethod() ][ $route->getUri() ] = $route;
		}

	}

	private function getRoutes (): array {
		return require APP_PATH . '/config/routes.php';
	}

	public function dispatch ( string $uri, string $method ): void {
		$route = $this->findMethod( $uri, $method );

		if (!$route) {
			$this->notFound();
		}

		$routes = $this->getRoutes();

		if (is_array($route->getAction())) {
			[$controller, $action] = $route->getAction();

			$controller = new $controller();

			call_user_func([$controller, $action]);
		}
		else {
			call_user_func($route->getAction());
		}
	}


	private function notFound() {
		echo '404 | Not found';
		exit;
	}

	public function findMethod ( string $uri, string $method ): Route|false {
		if ( ! isset( $this->routes[ $method ][ $uri ] ) ) {
			return false;
		}

		return $this->routes[ $method ][ $uri ];
	}


}