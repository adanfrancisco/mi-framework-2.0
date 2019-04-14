<?php

require_once 'Player.php';
require_once 'Tateti.php';

class TatetiController implements ControllerInterface
{    

    public function get($request,$argv)
    {   
        $players = [];
        $players[] = new Player(0, 'X', 'Ivan');
        $players[] = new Player(1, 'O', 'Pablo');
        $tateti = new Tateti($players);
        $tateti->run();
    }

    public function post($request,$argv)
    {
    }

}

