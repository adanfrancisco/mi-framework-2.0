<?php
namespace Mixplay;
class BattleShip
{
    private $playerA;
    private $playerB;
    private $currentPlayer;
    private $shots = [];


    public function __construct(BattleShipPlayer $p1, BattleShipPlayer $p2)
    {
        $this->playerA = $p1;
        $this->playerB = $p2;
        $this->currentPlayer=isset($_SESSION['currentPlayer'])?$_SESSION['currentPlayer']:'A';
        if (isset($_SESSION['shots'])) {
            $a = json_decode($_SESSION['shots'],true);
        }else {
            $a = [
                'A' => ['shots' => 0,'fails' => 0,'success' => 0],
                'B' => ['shots' => 0,'fails' => 0,'success' => 0]
            ];
        }
        $this->shots=$a;
        
            
    }
    public function play(int $x=null,int $y=null)
    {      
        if( isset($_SESSION['ganador']) ){
            $respuesta = new \stdClass;
            $respuesta->a = $_SESSION['ganador'];
            $respuesta->mensaje = $_SESSION['ganador'];
            return $respuesta;
        }else{           

            $llegaAPlay = "en play BattleShip llega: (".$x.",".$y.") player:".$this->currentPlayer."\n"; 
            if ($this->playerB->lose() > 0 && $this->playerA->lose() >0 ) 
            {
                if($this->currentPlayer === 'A'){

                    //SHOT PLAYER 1
                        //$shot = $this->playerA->sendShot();
                        $shot = array($x,$y);
                        $response = $this->playerB->receiveShot( $shot ) ;

                    // STATICS

                        $this->shots['A']['shots']++; //suma tiros
                        if($response->respuestaShot === 'AGUA')
                        {
                            $this->shots['A']['fails']++;// suma fails
                        }elseif($response->respuestaShot === 'BARCO') {
                            $this->playerA->setIA($shot);
                            $this->shots['A']['success']++;// suma aciertos
                        }else {
                            echo "error en shots";
                        }
                        
                    //CHANGE PLAYER

                        $this->currentPlayer ='B';

                }else {

                    //SHOT PLAYER 2
                        $shot = $this->playerB->sendShot();
                        $response = $this->playerA->receiveShot( $shot ) ;
                        $llegaAPlay = "en play BattleShip llega: (".$shot[0].",".$shot[1].") player:".$this->currentPlayer."\n"; 
 

                    // STATICS

                        $this->shots['B']['shots']++; //suma tiros
                        if($response->respuestaShot === 'AGUA') {
                            $this->shots['B']['fails']++;// suma fails
                        }elseif($response->respuestaShot === 'BARCO') {
                            $this->playerB->setIA($shot);
                            $this->shots['B']['success']++;// suma aciertos
                        }else {
                            echo "error en shots";
                        }

                    //CHANGE PLAYER

                        $this->currentPlayer ='A';

                }
                
                $_SESSION['shots']=json_encode($this->shots);           
                $_SESSION['currentPlayer']=$this->currentPlayer;
            }
            if($this->playerB->lose()==0)
            {
                $response = "ganador Player1: {$this->playerA->getName()}";
                $_SESSION['ganador'] = $response;            
            }elseif($this->playerA->lose()==0){
                $response = "ganador player2: {$this->playerB->getName()}"; 
                $_SESSION['ganador'] = $response;            
            
            }
            $respuesta = new \stdClass;
            $respuesta->a = $response;
            $respuesta->mensaje = ($this->playerB->lose() > 0 && $this->playerA->lose() > 0) ? $response->respuestaShot : $response;
            $respuesta->shot = $shot;
            $respuesta->llegaAPlay = $llegaAPlay;
        }   
        return $respuesta;       
    }
    public function printTable(){
        return $this->playerA->printTable();
    }
    //winner() chequea que niguno de los tableros esten sin barcos
    //shot( x,y ) el usuario de turno dispara al tablero del otro y recive un mensaje de Agua o Le diste a mi barco

}