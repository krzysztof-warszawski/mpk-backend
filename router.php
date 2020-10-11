<?php

require 'app/config/init.php';

use controller\BuildingController;
use controller\ProjectController;
use controller\ServiceTypeController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 600");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Headers, X-Requested-With, Access-Control-Allow-Methods");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'OPTIONS') {
    header("HTTP/1.1 204 No Content");
    exit;
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// read the URI
if (isset($uri[5]) && $uri[5] === 'projects') {
    $isProjectsOfBuilding = true;
    $uri[3] = 'projects';
} else {
    $isProjectsOfBuilding = false;
    $isOfferBuildings = isset($uri[4]) && $uri[4] === 'offer';
}
$id = isset($uri[4]) && ctype_digit($uri[4]) ? (int) $uri[4] : null;


switch ($uri[3]) {
    case 'projects':
        $projectController = new ProjectController($requestMethod, $id, $isProjectsOfBuilding);
        $projectController->processRequest();
        break;
    case 'buildings':
        $buildingController = new BuildingController($requestMethod, $id, $isOfferBuildings);
        $buildingController->processRequest();
        break;
    case 'service':
        $serviceTypeController = new ServiceTypeController($requestMethod);
        $serviceTypeController->processRequest();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit;
}
