<?php

namespace App\Kernel\Router;

use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\Http\Request;
use App\Kernel\Http\Redirect;
use App\Kernel\Session\Session;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes
        = [
            'GET'  => [],
            'POST' => [],
        ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
    ) {
        $this->initRoute();
    }

    private function initRoute()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * getRoutes
     *
     * @return array
     */
    private function getRoutes(): array
    {
        return require APP_PATH . '/config/routes.php';
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findMethod($uri, $method);

        if (! $route) {
            $this->notFound();
        }

        $routes = $this->getRoutes();

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();
            /** @var Controller $controller */
            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);

            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }


    private function notFound()
    {
        echo '404 | Not found';
        exit;
    }

    public function findMethod(string $uri, string $method): Route|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }
}
