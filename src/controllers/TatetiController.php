<?php
namespace Mixplay\Controllers;
/* 
require_once 'Player.php';
require_once 'Tateti.php'; */

class TatetiController implements ControllerInterface
{    

    public function get($request,$argv)
    {   
        $players = [];
        $players[] = new Player('Ivan',0, 'X');
        $players[] = new Player('Pablo',1, 'O');
        $tateti = new Tateti($players);
        $tateti->run();
    }

    public function post($request,$argv)
    {
        
    }

}

