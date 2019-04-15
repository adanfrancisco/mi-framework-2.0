<?php

require_once './Carta.php';
require_once "./Mazo.php";
require_once "./Player.php";

class Truco
{
    private $equipA = [];
    private $equipB = [];
    private $mazo;
    private $turno;

    const RONDAS = 3;

    private $puntajeA;
    private $puntajeB;
    
    public function __construct($equipA, $equipB){
        $this->equipA = $equipA;
        $this->puntajeA = 0;
        $this->equipB = $equipB;
        $this->puntajeB = 0;
        $this->turno = 'A';

        $this->mazo = new Mazo('española-40');
    }
    public function repartir(){
        for ($i=0; $i < count($this->equipA); $i++) { 
            $manoA = $this->mazo->repartirMano();
            $manoB = $this->mazo->repartirMano();
            $this->equipA[$i]->setMano( $manoA );
            $this->equipB[$i]->setMano( $manoB );            
        }
    }

    public function play(){
        /**
         * falta el envido
         */
        $puntajeA = 0;
        $puntajeB = 0;
        $this->repartir();
        /**
         * puede cantar truco y responder 
         * o pasar y cantar el otro
         */

        /**
         * tirar una carta x equipo digamos perira ronda ( son 3 )
         * sumar puntos 
         */
        $mesa = [];
        
        $rondas = self::RONDAS;
        for ($i=0; $i < $rondas || $rondas == 1; $i++) { 
            for ($j=0; $j < count($this->equipA); $j++) { 
                $mesa[] = $this->equipA[$j]->tirarcarta();
                $mesa[] = $this->equipB[$j]->tirarcarta();
            }
            $ronda = $this->checkCartasDeLaMesa($mesa);
            if( $ronda === 'A')
            {
                $puntajeA++;
                echo "gana ".($i+1)."° mano equipo A\n</br>";
                echo "\n</br>";
            }elseif ( $ronda === 'B') {
                $puntajeB++;
                echo "gana ".($i+1)."° mano equipo B\n</br>";
                echo "\n</br>";
            }else{
                $rondas--;
                echo "parda ".($i+1)."° mano \n</br>";
                echo "\n</br>";
            }
            $mesa=[];
        }
        if ($puntajeA > $puntajeB ) {
            $this->puntajeA++;
            echo "gana equipo A\n</br>";

        }else{
            $this->puntajeB++;
            echo "gana equipo B\n";

        }
        $this->mazo->devolverMano($mesa);
    }
    public function checkCartasDeLaMesa($mesa){
        $ganador=-1;
        $key = 0;
        $parda = '';
        foreach ($mesa as $i => $carta) {
            if($ganador < $carta->getGameValue())
            {
                $ganador = $carta->getGameValue();
                $key = $i;
                $parda='';
            }elseif ($ganador == $carta->getGameValue() && ($key%2 != $i%2) ) {
                $parda='E';
            }
        }
        if ($parda == '') {
            return ($key%2 === 0) ? 'A' : 'B';
        }else{
            return $parda;
        }
    }
}
