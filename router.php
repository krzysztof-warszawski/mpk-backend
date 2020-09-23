<?php

require 'app/config/init.php';
use controller\ProjectController;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestMethod = $_SERVER["REQUEST_METHOD"];

$id = isset($uri[4]) && ctype_digit($uri[4]) ? (int) $uri[4] : null;


switch ($uri[3]) {
    case 'projects':
        $projectController = new ProjectController($requestMethod, $id);
        $projectController->processRequest();
        break;
    case 'buildings':
        // todo: figure $uri[5] -> projects of the building (GET buildings/{id}/projects)
        break;
    case 'mpk':
        // todo
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit;
}
