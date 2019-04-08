<?php

namespace Mixplay\Controllers;

class NameController implements ControllerInterface
{    

    public static function get($request,$argv)
    {
        return isset($argv['name']) ? 'tu nombre es: '.$argv['name']. ' por GET' : 'you need "name" parameter'; 
    }
    public static function post($request,$argv)
    {
        return isset($argv['name']) && isset($argv['surname']) ? 'tu nombre es: '. $argv['surname'] .', '. $argv['name'] . ' por POST' : 'you need "name" and "surname" parameter';         
    }
    
}
