<?php
// ------------------------------------------------------------
// Custom Native MVC — Application Entry Point
// ------------------------------------------------------------

// Enable strict error reporting in dev
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set default timezone
date_default_timezone_set('Asia/Jakarta');

// Start Session
session_start();
define("UPLOAD_PATH", realpath("public/img"). DIRECTORY_SEPARATOR);

// Autoload Composer
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
    
    // Load .env variables
    if (file_exists(__DIR__ . '/.env')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
}

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