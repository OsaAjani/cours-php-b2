<?php
    include_once './pokemon.php';
    
    class Carapuce extends Pokemon
    {
        public function __construct ($level, $life = null)
        {
            $name = 'Carapuce';
            $max_life = 9 * $level;
            $life = min($life, $max_life) ?? $max_life;
            $type = 'eau';
            $strength = 2 * $level;

            parent::__construct($name, $max_life, $life, $level, $type, $strength);
        }

        public function level_up ()
        {
            $this->level ++;
            $this->max_life += 9;
            $this->life += 9;
            $this->strength += 2;

            echo $this->name . ' level up !' . "\n";
        }

        public static function say_hi ()
        {
            echo "Cara !\n";
        }

    }
