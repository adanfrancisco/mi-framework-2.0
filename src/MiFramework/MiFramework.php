<?php

namespace Mixplay\MiFramework;

class MiFramework
{
    private $rutes;
    private $rute = '';
    private $method = '';
    private $argv;
    
    public function __construct()
    {   
        Request::init();

        //echo Request::print()."</br>";

        
        
        $url = $_SERVER['REQUEST_URI'];
        $urlFull = strlen($_SERVER['REQUEST_URI']);
        $urlFake = strlen($_SERVER['SCRIPT_NAME']);
        $script = strlen('index.php');
        $this->argv = explode("/", substr( $url , - ( $urlFull - ($urlFake-$script) )  ) );
        $this->rute = Request::getURL();        
        $this->method = strtolower(Request::getType());
        $this->rutes = new Routes;
    }

    public function callMethod() 
    {
        $argv = [];

        //echo json_encode($this->argv);


        /*  "\/BattleShip\/"server 
            "get" method 
            "BattleShip" ruta  
        */


        /* echo ($_SERVER['REQUEST_URI'])." server <br>\n";
        echo $this->rute." ruta <br>\n"; */
        $url = substr($_SERVER['REQUEST_URI'],1);
        $url = substr($url,0,-1);
        /* echo json_encode($url)." url <br>\n"; */

        $result = $this->rutes->getRute($this->method,$url /* $this->rute/ *//* $_SERVER['REQUEST_URI'] */ ,$this->countArguments($this->argv));
        if(!is_string($result) ){
            if(count($result)>1){
                for ($i=1; $i < count($this->argv); $i++) { 
                    $argv[$result[$i]] = $this->argv[$i] ;
                }
            }  
            if(!empty($argv)){
                $this->argv = $argv; 
            }
            $controller = $result['controller'];
            
            return $controller->{$this->method}($_REQUEST,$this->argv);
            /*
                $response = $result['controller']::{$this->method}($_REQUEST,$this->argv);
                return $response->render();
            */
        }else {
            return $result;
        }
    }
    
    public function setRute(string $method, string $rute, $controller)
    {
        $this->rutes->setRute($method,$rute,$controller);
    } 

    public function run()
    {
        return $this->callMethod();
    }

    public function printRutes(){
        return json_encode( $this->rutes->printRutes() );
    }
    public function countArguments( $argv):int 
    {
        $count=0;
        foreach ($argv as $value) {
            if(!empty($value)){
                $count++;
            }
        }
        return $count-1;
    }
}