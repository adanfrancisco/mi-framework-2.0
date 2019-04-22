<?php




require_once './src/controllers/ControllerInterface.php';
require_once './src/controllers/RandController.php';
require_once './src/controllers/NameController.php';
require_once './mi-framework/MiFramework.php';
require_once './mi-framework/Routes.php';
require_once './mi-framework/Request.php';
require_once './mi-framework/Response.php';


use Mixplay\{
    Controllers\ControllerInterface as ControllerInterface,
    Controllers\RandController as RandController,
    Controllers\NameController as NameController,
    Controllers\BattleShipController as BattleShipController,
    Framework\MiFramework as MiFramework,
    Framework\Routes as Routes,
    Framework\Request as Request,
    Framework\Response as Response
};




$miFramework = new MiFramework;

$miFramework->setRute('GET','rand/', RandController::class);
$miFramework->setRute('GET','rand/{min}', RandController::class);
$miFramework->setRute('GET','rand/{min}/{max}', RandController::class);
$miFramework->setRute('POST','rand/', RandController::class);
$miFramework->setRute('POST','rand/{min}', RandController::class);
$miFramework->setRute('POST','rand/{min}/{max}', RandController::class);

$miFramework->setRute('GET','name/{name}', NameController::class);
$miFramework->setRute('POST','name/{name}/{surname}', NameController::class);
// Agregar mas controllers de juegos

$miFramework->setRute('GET','battleShip/', BattleShipController::class);




echo $miFramework->run();


/*
    node 
    express 
    react 
    lumin 
    laravel 
*/