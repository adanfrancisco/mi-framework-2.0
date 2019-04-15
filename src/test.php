<?php

require_once "./Mazo.php";
require_once "./Carta.php";
require_once "./Truco.php";
require_once "./Player.php";


//$mazo = new Mazo( 'española-40' );
//var_dump($mazo);
//$mano = $mazo->repartirMano();
//var_dump( $mano );
/*
        check game rules

    if ( $mano[0]->getGameValue() > $mano[1]->getGameValue() ) {
        echo "El {$mano[0]->getValue()}-{$mano[0]->getType()}-{$mano[0]->getGameValue()} es mayor que {$mano[1]->getValue()}-{$mano[1]->getType()}-{$mano[1]->getGameValue()}\n";
    }else {
        echo "El {$mano[0]->getValue()}-{$mano[0]->getType()}-{$mano[0]->getGameValue()} es menor que {$mano[1]->getValue()}-{$mano[1]->getType()}-{$mano[1]->getGameValue()}\n";
    }

    if ( $mano[1]->getGameValue() > $mano[2]->getGameValue() ) {
        echo "El {$mano[1]->getValue()}-{$mano[1]->getType()}-{$mano[1]->getGameValue()} es mayor que {$mano[2]->getValue()}-{$mano[2]->getType()}-{$mano[2]->getGameValue()}\n";
    }else {
        echo "El {$mano[1]->getValue()}-{$mano[1]->getType()}-{$mano[1]->getGameValue()} es menor que {$mano[2]->getValue()}-{$mano[2]->getType()}-{$mano[2]->getGameValue()}\n";
    }

    if ( $mano[0]->getGameValue() > $mano[2]->getGameValue() ) {
        echo "El {$mano[0]->getValue()}-{$mano[0]->getType()}-{$mano[0]->getGameValue()} es mayor que {$mano[2]->getValue()}-{$mano[2]->getType()}-{$mano[2]->getGameValue()}\n";
    }else {
        echo "El {$mano[0]->getValue()}-{$mano[0]->getType()}-{$mano[0]->getGameValue()} es menor que {$mano[2]->getValue()}-{$mano[2]->getType()}-{$mano[2]->getGameValue()}\n";
    }
*/
$p1 = new Player('ivan',1,'A');
$p2 = new Player('pablo',2,'A');
$p3 = new Player('leo',3,'B');
$p4 = new Player('amir',4,'B');

$teamA = array( $p1,$p2 );
$teamB = array( $p3,$p4 );

$truco = new Truco($teamA,$teamB);
$truco->play();
