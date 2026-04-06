<?php
// ------------------------------------------------------------
// Custom Native MVC — Application Entry Point
// ------------------------------------------------------------

// Enable strict error reporting in dev
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start Session
session_start();
define("UPLOAD_PATH", realpath("public/img"). DIRECTORY_SEPARATOR);

// Load all core files
require_once __DIR__ . '/app/core/App.php';
require_once __DIR__ . '/app/core/Database.php';

// Start the application
try {
    $app = new App();
} catch (Exception $e) {
    http_response_code(500);
    echo "<h1>Internal Server Error</h1>";
    echo "<p>{$e->getMessage()}</p>";
}