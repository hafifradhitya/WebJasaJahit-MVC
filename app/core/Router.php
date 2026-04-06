<?php

require_once __DIR__ . '/Database.php';

class Router
{
    private array $routes = [];
    private Database $db;

    public function __construct()
    {
        // Initialize one shared Database instance
        $this->db = new Database();
    }

    /** -------------------------------------------
     * Register GET route
     * Example: $router->get('users', 'UserController@index');
     * ------------------------------------------*/
    public function get(string $path, string $action): void
    {
        $this->addRoute('GET', $path, $action);
    }

    /** -------------------------------------------
     * Register POST route
     * Example: $router->post('users/create', 'UserController@store');
     * ------------------------------------------*/
    public function post(string $path, string $action): void
    {
        $this->addRoute('POST', $path, $action);
    }

    /** -------------------------------------------
     * Store route in routes array
     * ------------------------------------------*/
    private function addRoute(string $method, string $path, string $action): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path'   => trim($path, '/'),
            'action' => $action
        ];
    }

    /** -------------------------------------------
     * Dispatch incoming request to the right controller
     * ------------------------------------------*/
    public function dispatch(): void
    {
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $url) {
                $this->callAction($route['action']);
                return;
            }
        }

        $this->handleNotFound();
    }

    /** -------------------------------------------
     * Resolve and call the controller action
     * ------------------------------------------*/
    private function callAction(string $action): void
    {
        [$controllerName, $method] = explode('@', $action);

        $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerPath)) {
            $this->handleNotFound();
        }

        require_once $controllerPath;

        // inject Database dependency automatically
        $controller = new $controllerName($this->db);

        if (!method_exists($controller, $method)) {
            $this->handleNotFound();
        }

        $controller->$method();
    }

    /** -------------------------------------------
     * Handle 404 errors
     * ------------------------------------------*/
    private function handleNotFound(): void
    {
        http_response_code(404);
        $errorPage = __DIR__ . '/../views/errors/404.php';
        if (file_exists($errorPage)) {
            require_once $errorPage;
        } else {
            echo "<h1>404 - Page Not Found</h1>";
        }
        exit;
    }
}