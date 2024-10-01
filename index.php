<?php
// Initialize Composer autoloading

use Config\Connection;

require_once 'vendor/autoload.php';
// Connection::start();

// Define your routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Simple routing mechanism
switch ($uri) {
    case '/dashboard':
        require 'View/Dashboard.php';
        break;
    case '/users':
        require 'View/User.php';
        break;
    case '/kendaraans':
        require 'View/Paket/Kendaraan.php';
        break;
    case '/auth/login':
        require 'View/Login.php';
        break;
    case '/auth/register':
        require 'View/Registrasi.php';
        break;
    case '/conn':
        require 'config/Connection.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
