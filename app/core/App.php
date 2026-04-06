<?php
/**
 * ------------------------------------------------------------
 *  Application Core (App.php)
 * ------------------------------------------------------------
 *  This class initializes the core of the custom-native-mvc app.
 *  It handles autoloading, bootstrapping, and routing.
 * ------------------------------------------------------------
 */

require_once __DIR__ . '/Router.php';

class App
{
    protected Router $router;


    public function __construct()
    {
        $this->initRouter();   //  1: initialize router
        $this->loadRoutes();   //  2: load routes
        $this->dispatch();     //  3: handle the request
    }

    /**
     * Initialize the Router instance
     */
    private function initRouter(): void
    {
        $this->router = new Router();
    }

    /**
     * Load application routes from /routes.php
     */
    private function loadRoutes(): void
    {
        // Make router available inside routes.php
        $router = $this->router;
        $routesFile = __DIR__ . '/../config/routes.php';

        if (file_exists($routesFile)) {
            require_once $routesFile;
        } else {
            throw new Exception("Routes file not found at: {$routesFile}");
        }
    }

    /**
     * Dispatch the current request
     */
    private function dispatch(): void
    {
        $this->router->dispatch();
    }
}