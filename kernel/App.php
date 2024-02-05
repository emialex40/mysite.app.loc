<?php

namespace App\Kernel;

use App\Kernel\Container\Container;

/**
 * Class App
 *
 * The App class represents the main application entry point.
 * It initializes the container and runs the application by dispatching the router based on the request.
 */
class App
{
    private $container;
    /**
     * Constructs a new instance of the class.
     * Initializes the container property with a new instance of the Container class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * Dispatches the request to the appropriate route.
     *
     * This method retrieves the URI and HTTP method from the request object, and uses them to dispatch
     * the request to the correct route in the router object.
     *
     * @return void
     */
    public function run(): void
    {
        $this->container->router->dispatch($this->container->request->uri(), $this->container->request->method());
    }
}
