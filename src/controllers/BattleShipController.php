<?php   
    namespace Mixplay\Controllers;
    //require_once './ControllerInterface.php';


    class BattleShipController implements ControllerInterface
    {  

        public function get($request,$argv)
        {
            $player1 = new BattleShipPlayer('Ivan');
            $player2 = new BattleShipPlayer('Leo');
            $battleShip = new BattleShip($player1,$player2);
            echo $battleShip->printTable();
            $battleShip->play();
            
        }

        public function post($request,$argv)
        {
        }
    }
