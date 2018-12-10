<?php
    include './pokemon7.php';
    
    class Carapuce extends Pokemon
    {
        public function __construct ($level, $life = null)
        {
            $name = 'Carapuce';
            $max_life = 100 + 5 * $level;
            $life = $life ?? $max_life;
            $type = 'eau';
            $strength = 10 + 2 * $level;

            parent::__construct($name, $max_life, $life, $level, $type, $strength);
        }

        public static function say_hi ()
        {
            echo "Cara !\n";
        }

    }

    $carapuce = new Carapuce(5, 100);
    var_dump($carapuce);