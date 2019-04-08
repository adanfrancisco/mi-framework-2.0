<?php


require_once 'vendor/autoload.php';

require_once 'src/ControllerInterface.php';
require_once 'src/RandController.php';
require_once 'src/NameController.php';
require_once 'mi-framework/MiFramework.php';
require_once 'mi-framework/Routes.php';
require_once 'mi-framework/Request.php';
require_once 'mi-framework/Response.php';


use Mixplay\{
    Controllers\ControllerInterface as ControllerInterface,
    Controllers\RandController as RandController,
    Controllers\NameController as NameController,
    Framework\MiFramework as MiFramework,
    Framework\Routes as Routes,
    Framework\Request as Request,
    Framework\Response as Response,
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
// Agregar mas controllers



echo $miFramework->run();



/** TEMPLATE TWIG */

/**
 * ver unos videos de twig
 * 
 */

/*
    $loader = new \Twig\Loader\ArrayLoader([
        'index' => 'Hello {{ name }}!',
    ]);
    $twig = new \Twig\Environment($loader);

    echo $twig->render('index', ['name' => 'Fabien']);
*/


/*
    node 
    express 
    react 
    lumin 
    laravel 
*/