<?php

declare(strict_types=1);

spl_autoload_register(function(string $classNamespace){
    $path = str_replace(["\\", 'App/'], ["/", ''], $classNamespace);
    $path = "src/$path.php";
    require_once($path);
});

use App\Controller\AbstractController;
use App\Controller\WebController;
use App\Request;

$request = new Request($_GET, $_POST, $_SERVER);

$configurationDb = require_once('config/config.php');

AbstractController::initConfiguration($configurationDb);

(new WebController($request))->run();

/*
$action = $_GET['action'] ?? DEFAULT_PAGE;

$view = new View();

$view->render($action);
*/
