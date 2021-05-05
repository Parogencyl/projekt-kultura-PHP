<?php 

declare(strict_types=1);

spl_autoload_register(function(string $classNamespace){
    $path = str_replace(["\\", 'App/'], ["/", ''], $classNamespace);
    $path = "src/$path.php";
    require_once($path);
});

use App\Controller\AbstractController;
use App\Controller\AdminController;
use App\Request;

$configurationDb = require_once('config/config.php');

$request = new Request($_GET, $_POST, $_SERVER);

AbstractController::initConfiguration($configurationDb);

(new AdminController($request))->run(true);
