
<?php


require_once './src/controllers/ControllerInterface.php';
require_once './src/controllers/RandController.php';
require_once './src/controllers/NameController.php';
require_once './mi-framework/MiFramework.php';
require_once './mi-framework/Routes.php';
require_once './mi-framework/Request.php';
require_once './mi-framework/Response.php';
require_once './src/Tateti.php';
require_once './src/Player.php';
require_once './src/BattleShip.php';
require_once './src/BattleShipPlayer.php';



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
use Player;
use BattleShip;
use BattleShipPlayer;


    require './vendor/autoload.php';

$players[] = new Player('Ivan',0, 'X');
$players[] = new Player('Pablo',1, 'O');
$battleShipPlayer = new BattleShipPlayer('pablo');
echo $battleShipPlayer->printTable();
$tateti->run();


