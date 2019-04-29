<?php
namespace Mixplay\Controllers;


/* require_once 'Player.php';
require_once 'Truco.php'; */

class TrucoController implements ControllerInterface
{    

    public function get($request,$argv)
    {   
        $players = [];
        $mano = array(4, 5, 10);
        $players[] = new Player(0, 'X', 'Ivan');
        $players[] = new Player(1, 'O', 'Pablo');
        $truco = new Truco($players);
        $truco->run();
        /***
         * function calcularTanto($mano)
                {
                    $envido=20;
                    for ($i=0;$i<count($mano); $i++)
                    {        
                        if($mano[$i]<8)
                        {
                            $envido+=$mano[$i];
                        }
                    }
                    
                    return $envido;
                }
                var_dump($mano);
                echo "el envido es: ".calcularTanto($mano);
         */
    }

    public function post($request,$argv)
    {
    }

}




