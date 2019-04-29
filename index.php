<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require './vendor/autoload.php';

/* FRAMEWORK */
/*
    require_once './mi-framework/MiFramework.php';
    require_once './mi-framework/Routes.php';
    require_once './mi-framework/Request.php';
    require_once './mi-framework/Response.php';*/

/* CONTROLLERS */
/*
    require_once './src/controllers/ControllerInterface.php';
    require_once './src/controllers/RandController.php';
    require_once './src/controllers/NameController.php';
    require_once './src/controllers/BattleShipController.php';
    require_once './src/controllers/TatetiController.php';
    require_once './src/controllers/TrucoController.php';
    */

/* CLASS */
/*
    require_once './src/BattleShip.php';
    require_once './src/BattleShipPlayer.php';
    require_once './src/Carta.php';
    require_once './src/Mazo.php';
    require_once './src/Player.php';
    require_once './src/Ship.php';
    require_once './src/Tateti.php';
    require_once './src/Truco.php';
    */
/** */
use Mixplay\{
    /* FRAMEWORK */
        Framework\MiFramework as MiFramework,
        Framework\Routes as Routes,
        Framework\Request as Request,
        Framework\Response as Response,
    /* CONTROLLERS */
        Controllers\ControllerInterface as ControllerInterface,
        Controllers\RandController as RandController,
        Controllers\NameController as NameController,
        Controllers\BattleShipController as BattleShipController,
        Controllers\TatetiController as TatetiController,
        Controllers\TrucoController as TrucoController,
    /* CLASS */
        BattleShip\BattleShip as BattleShip,
        BattleShip\BattleShipPlayer as BattleShipPlayer,
        BattleShip\Ship as Ship,
        Carta as Carta,
        Mazo as Mazo,
        Player as Player,
        Tateti as Tateti,
        Truco as Truco
};



require './vendor/autoload.php';





$miFramework = new MiFramework;

$miFramework->setRute('GET','rand/', RandController::class);
$miFramework->setRute('GET','rand/{min}', RandController::class);
$miFramework->setRute('GET','rand/{min}/{max}', RandController::class);
$miFramework->setRute('POST','rand/', RandController::class);
$miFramework->setRute('POST','rand/{min}', RandController::class);
$miFramework->setRute('POST','rand/{min}/{max}', RandController::class);

$miFramework->setRute('GET','name/{name}', NameController::class);
$miFramework->setRute('POST','name/{name}/{surname}', NameController::class);

$miFramework->setRute('GET','battleShip/', BattleShipController::class);




echo $miFramework->run();


/*
    node 
    express 
    react 
    lumin 
    laravel 
*/