<?php


class Player 
{
    private $id;
    private $key = 'X';
    private $name = '';
    private $mano = [];
    private $truco;
    private $cantarEnvido;
    private $valorManoEnvido;

    const MAX_VALUE_TRUCO = 114;


    public function __construct(string $name, int $id = null, string $key = null )
    {
        $this->id = $id;
        $this->key = $key;
        $this->name = $name;
        $this->truco = [];
        $this->cantarEnvido = [];        
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
        echo "</br>".$this->show()."</br>";
        $this->valorManoTruco();
        $this->valorManoEnvido = $this->calcularValorManoEnvido();
        var_dump( $this->truco, $this->cantarEnvido);
        //echo "tanto de {$this->name}: {$this->calcularValorManoEnvido( $this->mano )}</br>";
        $this->valorManoEnvido = $this->calcularValorManoEnvido( $this->mano );

    }
    public function tirarcarta()
    {   
        $carta = array_pop($this->mano);
        echo "{$this->name} del equipo {$this->key} tira <img src=".$carta->getImg()." alt='Smiley face' height='42' width='42'></br>";
        return $carta;
    }

    public function show($mano = null)
    {
        if ($mano===null) {
            $mano = $this->mano;
        }
        $respuesta = '';
        foreach ($mano as $carta) {
            $respuesta .= "<img src=".$carta->getImg()." alt='Smiley face' height='42' width='42'>";
        }
        return $respuesta;
    }

    public function valorManoTruco(){
        $score = 0;
        foreach ($this->mano as $carta) {
            $score += $carta->getGameValue();
            //var_dump( $carta->getGameValue() );
        }
        echo "score {$score}";
        if(self::MAX_VALUE_TRUCO * (7/9) < $score){
            // si truco
            $this->truco['truco'] = 1;
            // si retruco
            $this->truco['retruco'] = 1;
            // si vale cuatro
            $this->truco['vale-cuatro'] = 1;

        }elseif(self::MAX_VALUE_TRUCO * (6/9) < $score)  {
            // si truco
            $this->truco['truco'] = 1;
            // si retruco
            $this->truco['retruco'] = 1;
            // no vale cuatro
            $this->truco['vale-cuatro'] = 0;
        }elseif(self::MAX_VALUE_TRUCO * (5/9) < $score){
            // si truco
            $this->truco['truco'] = 1;
            // no retruco
            $this->truco['retruco'] = 0;
            // no vale cuatro
            $this->truco['vale-cuatro'] = 0;
        }elseif(self::MAX_VALUE_TRUCO * (4/9) < $score){
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
    public function calcularValorManoEnvido(){

        $manoParaElEnvido = [];

        foreach ($this->mano as $carta) {
            $manoParaElEnvido[ $carta->getType() ][] = $carta;
        }
        $tanto = 0;
        foreach ($manoParaElEnvido as $mano) {
            //echo $this->show($mano)."</br>";
            if( $this->calcularTanto( $mano ) > $tanto){
                $tanto = $this->calcularTanto( $mano);
            }
        }
        $cantarEnvido = [];
        echo "tanto : $tanto";
        if( $tanto > 30 ){
            $cantarEnvido['envido'] = 1;
            $cantarEnvido['realEnvido'] = 1;
            $cantarEnvido['envido-envido'] = 1;
            $cantarEnvido['envido-realEnvido'] = 1;
            $cantarEnvido['envido-envido-realEnvido'] = 1;
            $cantarEnvido['faltaEnvido'] = 1;
        }elseif( $tanto > 27 ){
            $cantarEnvido['envido'] = 1;
            $cantarEnvido['realEnvido'] = 1;
            $cantarEnvido['envido-envido'] = 1;
            $cantarEnvido['envido-envido-realEnvido'] = 0;
            $cantarEnvido['envido-realEnvido'] = 0;
            $cantarEnvido['faltaEnvido'] = 0;
        }elseif( $tanto > 23 ){
            $cantarEnvido['envido'] = 1;
            $cantarEnvido['realEnvido'] = 0;
            $cantarEnvido['envido-envido'] = 0;
            $cantarEnvido['envido-envido-realEnvido'] = 0;
            $cantarEnvido['envido-realEnvido'] = 0;
            $cantarEnvido['faltaEnvido'] = 0;
        }else {
            $cantarEnvido['envido'] = 0;
            $cantarEnvido['realEnvido'] = 0;
            $cantarEnvido['envido-envido'] = 0;
            $cantarEnvido['envido-envido-realEnvido'] = 0;
            $cantarEnvido['envido-realEnvido'] = 0;
            $cantarEnvido['faltaEnvido'] = 0;
        }
        $this->cantarEnvido = $cantarEnvido;
        return $tanto; 
    }
    function calcularTanto($mano)
    {
        $max = 0;
        if ( count($mano) >1){
            $envido=20;
        }else{
            $envido=0;
        }
        for ($i=0;$i<count($mano); $i++)
        {             
            if($mano[$i]->getValue() < 8)
            {
                for ($j=0; $j < count($mano); $j++) { 
                    if ($i!=$j) {
                        $cartaParaComparar = $mano[$j]->getValue() < 8 ? $mano[$j]->getValue() : 0 ; 
                        $max = ($mano[$i]->getValue() + $cartaParaComparar > $max) ?  $mano[$i]->getValue() + $cartaParaComparar : $max;          
                    }elseif(count($mano) == 1){
                        $max = $mano[$i]->getValue();
                    }
                }
            }
            
        }
        $envido+=$max;
        
        return $envido;
    }

    public function cantarEnvido(){}

    
}