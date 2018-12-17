<?php
    include_once './pokemon.php';
    
    class Salameche extends Pokemon
    {
        public function __construct ($level, $life = null)
        {
            $name = 'Salameche';
            $max_life = 5 * $level;
            $life = min($life, $max_life) ?? $max_life;
            $type = 'feu';
            $strength = 4 * $level;

            parent::__construct($name, $max_life, $life, $level, $type, $strength);
        }

        public function level_up ()
        {
            $this->level ++;
            $this->max_life += 5;
            $this->life += 5;
            $this->strength += 4;

            echo $this->name . ' level up !' . "\n";
        }

        public static function say_hi ()
        {
            echo "Sala !\n";
        }

    }
