<?php
class Mazo
{
    public $mazo = [];
    public $type ='';

    public function __construct( string $type = null)
    {
        $this->type = $type;
        $this->makeMazo();
    }

    public function makeMazo( )
    {   
        switch ($this->type) {
            case 'pokker':
                $palo = ['Pica', 'Trebol', 'Diamantes', 'Corazones'];
                break;
            
            case 'española':
            case 'española-40':
                $palo = ['Basto', 'Espada', 'Oro', 'Copa'];
                break;
            default:
                echo 'algo salió mal en la creación del mazo';
                break;
        }
        $p = 0;
        for ($i=0; $i < 48 ; $i++) { 
            if( ($i+1) % 12 === 0 && $i != 47)
            {
                $p++;
            }
            !($this->type === 'española-40' && ( ( ($i) % 12 )+1 == 8 || ( ($i) % 12 )+1 == 9) )? $this->mazo[] = new Carta( ( ($i) % 12 )+1, $palo[$p], "./img/".$palo[$p]."/".( ( ($i) % 12 )+1).".jpg" ) : 0;
        }
        if($this->type != 'española-40'){
            $this->mazo[] = new Carta(  0 , 'comodin', "./img/comodin.jpg" );
            $this->mazo[] = new Carta(  0 , 'comodin', "./img/comodin.jpg" );
        }else {
            $valores = [ 
                'Basto' => [ 
                    1 => 38,
                    2 => 28,
                    3 => 32,
                    4 => 0,
                    5 => 4,
                    6 => 8,
                    7 => 12,
                    10 => 14,
                    11 => 18,
                    12 => 22
                ],
                'Espada' => [ 
                    1 => 39,
                    2 => 28,
                    3 => 32,
                    4 => 0,
                    5 => 4,
                    6 => 8,
                    7 => 37,
                    10 => 14,
                    11 => 18,
                    12 => 22
                ],
                'Oro' => [ 
                    1 => 26,
                    2 => 28,
                    3 => 32,
                    4 => 0,
                    5 => 4,
                    6 => 8,
                    7 => 36,
                    10 => 14,
                    11 => 18,
                    12 => 22
                ], 
                'Copa' => [ 
                    1 => 26,
                    2 => 28,
                    3 => 32,
                    4 => 0,
                    5 => 4,
                    6 => 8,
                    7 => 12,
                    10 => 14,
                    11 => 18,
                    12 => 22
                ]
            ];
            //var_dump($valores);
            foreach ($this->mazo as $key => $carta) {
                $this->mazo[$key]->setGameValue( $valores[ $carta->getType()][ $carta->getValue()] );
            }
        }

    }
    public function repartirMano(){
        $this->mezclar();
        return array(array_pop( $this->mazo  ), array_pop( $this->mazo  ), array_pop( $this->mazo  ) );
    }
    public function devolverMano($meza){
        foreach ($meza as $carta) {
            array_push($this->mazo, $carta);
        }
    }
    public function getMazo(){
        
        return $this->mazo;
    }
    private function mezclar(){
        for ($i=0; $i < 10; $i++) { 
            shuffle($this->mazo );
        }
    }

    public function getCountCarts(){
        return count( $this->mazo );
    }
}