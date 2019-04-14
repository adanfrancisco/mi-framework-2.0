<?php

    require_once 'Player.php';
    require_once 'Ship.php';
    require_once 'BattleShip.php';
    require_once 'BattleShipPlayer.php';


    class NameController implements ControllerInterface
    {  

        public function get($request,$argv)
        {
            $player1 = new BattleShipPlayer('Ivan');
            $player2 = new BattleShipPlayer('Leo');
            $battleShip = new BattleShip($player1,$player2);
            $battleShip->play();
        }

        public function post($request,$argv)
        {
        }
    }
