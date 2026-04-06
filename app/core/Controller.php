<?php
/**
 * Base abstract Controller class
 * 
 * Purpose: Architectural placeholder to show MVC structure.
 * Other controllers extend this for consistent organization.
 */

require_once __DIR__ . '/Database.php';

abstract class Controller
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->boot(); // optional initialization
    }

    /**
     * Optional method for child controllers to override
     * e.g. load models, set up traits, etc.
     */
    protected function boot(): void
    {
        // Can be overridden in child controller
    }

    /**
     * Load a model easily
     * Example: $this->model('User');
     */
    protected function model(string $model)
    {
        $path = __DIR__ . '/../models/' . $model . '.php';
        if (file_exists($path)) {
            require_once $path;
            return new $model($this->db);
        }

        throw new Exception("Model {$model} not found");
    }

    /**
     * Render a view
     * Example: $this->view('user/index', ['users' => $data]);
     */
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $file = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "<h3>View '{$view}' not found.</h3>";
        }
    }
}