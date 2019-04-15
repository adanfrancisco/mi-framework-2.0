<?php


class Player 
{
    private $id;
    private $key = 'X';
    private $name = '';
    private $mano = [];

    public function __construct(string $name, int $id = null, string $key = null )
    {
        $this->id = $id;
        $this->key = $key;
        $this->name = $name;
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
        echo "{$this->name} tira {$carta->show()} equipo {$this->getKey()}\n";
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
    
    
}
