<?php


class Player 
{
    private $id;
    private $key = 'X';
    private $name = '';
    private $mano = [];
    private $truco;
    private $envido;
    private $valorManoEnvido;

    const MAX_VALUE_tRUCO = 39 + 38 + 37;


    public function __construct(string $name, int $id = null, string $key = null )
    {
        $this->id = $id;
        $this->key = $key;
        $this->name = $name;
        $this->truco = [];
        $this->cantarEnvido = [];
        $this->valorManoTruco();
    }

    public function getKey()
    {
        return $this->key;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setMano($mano)
    {
        $this->mano = $mano;
    }
    public function tirarcarta()
    {   $carta = array_pop($this->mano);
        echo "{$this->name} del equipo {$this->key} tira <img src=".$carta->getImg()." alt='Smiley face' height='42' width='42'></br>";
        return $carta;
    }

    public function show()
    {
        $respuesta = '';
        foreach ($this->mano as $carta) {
            $respuesta .= $carta->getType()." - ".$carta->getvalue()."\n";
        }
        return $respuesta;
    }

    public function valorManoTruco(){
        $score = 0;
        foreach ($this->mano as $carta) {
            $score += $carta->getGameValue();
        }
        if(self::MAX_VALUE_TRUCO * (6/7) < $score){
            // si truco
            $this->truco['truco'] = 1;
            // si retruco
            $this->truco['retruco'] = 1;
            // si vale cuatro
            $this->truco['vale-cuatro'] = 1;

        }elseif(self::MAX_VALUE_TRUCO * (5/7) < $score)  {
            // si truco
            $this->truco['truco'] = 1;
            // si retruco
            $this->truco['retruco'] = 1;
            // no vale cuatro
            $this->truco['vale-cuatro'] = 0;
        }elseif(self::MAX_VALUE_TRUCO * (4/7) < $score){
            // si truco
            $this->truco['truco'] = 1;
            // no retruco
            $this->truco['retruco'] = 0;
            // no vale cuatro
            $this->truco['vale-cuatro'] = 0;
        }elseif(self::MAX_VALUE_TRUCO * (3/7) < $score){
            // si truco
            $this->truco['truco'] = 1;
            // no retruco
            $this->truco['retruco'] = 0;
            // no vale cuatro
            $this->truco['vale-cuatro'] = 0;
        }else{
            // no truco
            $this->truco['truco'] = 0;
            // no retruco
            $this->truco['retruco'] = 0;
            // no vale cuatro
            $this->truco['vale-cuatro'] = 0;
        }
    }

    public function cantarTruco(string $queCantar) : boolean{
        return $this->truco[$queCantar];
    }
    public function valorManoEnvido(){
        $manoParaElEnvido = [];
        foreach ($this->mano as $carta) {
            $manoParaElEnvido[$carta->getType()][] = $carta;
        }
        $countManoMaxima = 0;
        $k = -1;
        foreach ($manoParaElEnvido as $key => $mano) {
            if(  $countManoMaxima < count($mano) ){
                $countManoMaxima = count($mano);
                $k = $key;
            }
        }
        $manoParaElEnvido = $manoParaElEnvido[$key];
    }
    public function cantarEnvido(){}

    
}