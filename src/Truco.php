<?php

require_once './Carta.php';
require_once "./Mazo.php";
require_once "./Player.php";

class Truco
{
    private $equipA;
    private $equipB;
    private $mazo;
    private $puntajeA;
    private $puntajeB;
    private $turno;
    
    public function __construct($equipA, $equipB){
        $this->equipA = $equipA;
        $this->puntajeA = 0;
        $this->equipB = $equipB;
        $this->puntajeB = 0;
        $this->turno = 'A';

        $this->mazo = new Mazo('española-40');
        //var_dump( $this->mazo );
    }
    public function repartir(){
        $manoA = $this->mazo->repartirMano();
        $manoB = $this->mazo->repartirMano();
        $this->equipA->setMano( $manoA );
        $this->equipB->setMano( $manoB );
        var_dump($this->equipA->show());
        var_dump($this->equipB->show());
        echo "quedan {$this->mazo->getCountCarts()} en el mazo \n";
    }

    public function play(){
        /**
         * falta el envido
         */
        $puntajeA = 0;
        $puntajeB = 0;
        /**
         * puede cantar truco y responder 
         * o pasar y cantar el otro
         */
        for ($i=0; $i < 3; $i++) { 
            $this->equipA->tirarcarta();
        }
    }
}


$a = new Player('juan');
$b = new Player('maria');

$truco = new Truco($a,$b);
$truco->repartir();
$truco->play();
