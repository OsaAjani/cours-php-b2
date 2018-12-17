<?php
    include './pokemon6.php';
    
    class Carapuce extends Pokemon
    {
    }

    $carapuce = new Carapuce('Carapuce', 125, 125, 5, 'eau', 20);
    var_dump($carapuce);