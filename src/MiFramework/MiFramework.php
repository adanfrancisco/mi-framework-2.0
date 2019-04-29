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
        $url = $_SERVER['REQUEST_URI'];
        $urlFull = strlen($_SERVER['REQUEST_URI']);
        $urlFake = strlen($_SERVER['SCRIPT_NAME']);
        $script = strlen('index.php');
        $this->argv = explode("/", substr( $url , - ( $urlFull - ($urlFake-$script) )  ) );
        $this->rute = $this->argv[0];        
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->rutes = new Routes;
    }

    public function callMethod() 
    {
        $argv = [];
        $result = $this->rutes->getRute($this->method, $this->rute,$this->countArguments($this->argv));
        if(!is_string($result) ){
            if(count($result)>1){
                for ($i=1; $i < count($this->argv); $i++) { 
                    $argv[$result[$i]] = $this->argv[$i] ;
                }
            }  
            if(!empty($argv)){
                $this->argv = $argv; 
            }
            $controller = new $result['controller'];
            
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