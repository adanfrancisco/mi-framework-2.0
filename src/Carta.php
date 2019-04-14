<?php

    class Carta
    {
        private $type;
        private $value;
        private $gameValue;
        public $img = '';


        public function __construct(int $value , string $type){
            $this->type = $type;
            $this->value = $value;
        }
        public function getType(){
            return $this->type;
        }
        public function getValue(){
            return $this->value;
        }
        public function getGameValue(){
            return $this->value;
        }
        public function setGameValue(int $gameValue){
            $this->gameValue = $gameValue;
        }

    }
    