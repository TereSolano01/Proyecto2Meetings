<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 1);

session_start();

// Habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

if (file_exists(__DIR__ . '/public' . $_SERVER["REQUEST_URI"])) {
    return false;
}

if (strpos($_SERVER["REQUEST_URI"], '/server/') === 0) {
    require('PHPFramex.php');
    require('routes.php');
    exit();
}

require_once __DIR__ . '/public/index.html';
?>
