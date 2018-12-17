<?php
    include_once './pokemon.php';
    
    class Bulbizarre extends Pokemon
    {
        public function __construct ($level, $life = null)
        {
            $name = 'Bulbizarre';
            $max_life = 7 * $level;
            $life = min($life, $max_life) ?? $max_life;
            $type = 'herbe';
            $strength = 3 * $level;

            parent::__construct($name, $max_life, $life, $level, $type, $strength);
        }

        public function level_up ()
        {
            $this->level ++;
            $this->max_life += 7;
            $this->life += 7;
            $this->strength += 3;

            echo $this->name . ' level up !' . "\n";
        }

        public static function say_hi ()
        {
            echo "Bulbi !\n";
        }

    }
