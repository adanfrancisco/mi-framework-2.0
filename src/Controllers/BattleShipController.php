<?php   
    namespace Mixplay\Controllers;
    //require_once './ControllerInterface.php';
    use Mixplay\{
        BattleShipPlayer as BattleShipPlayer,
        BattleShip as BattleShip
    };

    class BattleShipController implements ControllerInterface
    {  

        public function get($request,$argv)
        {   
            session_destroy();
            session_start();           
            $player1 = new BattleShipPlayer('Ivan');    
            $player2 = new BattleShipPlayer('Leo');
            $battleShip = new BattleShip($player1,$player2);
            echo $battleShip->printTable();
            $_SESSION['p1'] = $player1->serializeToJson();
            $_SESSION['p2'] = $player2->serializeToJson();           
        }

        public function post($request,$argv)
        {   
            if( isset($_SESSION['p1']) && isset($_SESSION['p2'])){
                $player1 = new BattleShipPlayer('Ivan',unserialize($_SESSION['p1']));    
                $player2 = new BattleShipPlayer('Leo',unserialize($_SESSION['p2']));
                //var_dump($player1);
            }else{
                $player1 = new BattleShipPlayer('Ivan');    
                $player2 = new BattleShipPlayer('Leo');
                $player1->setEnemyTable( $player2->getTable());
                $player2->setEnemyTable( $player1->getTable());

            }

            $battleShip = new BattleShip($player1,$player2);
            //echo $battleShip->printTable();
            //echo "en el post-controller llega ({$request['x']},{$request['y']})<br>";
            
            $response = $battleShip->play($request['x'] ,$request['y'] );
            $response2 = $battleShip->play();
            $_SESSION['p1'] = $player1->serializeToJson();
            $_SESSION['p2'] = $player2->serializeToJson();
            return json_encode([$response,$response2]);
        }
    }
