<?php
    
    class Pokemon 
    {
        public $name;
        public $max_life;
        public $life;
        public $level;
        public $type;
        public $strength;

        public function __construct ($name, $max_life, $life, $level, $type, $strength)
        {
            $this->name = $name;
            $this->max_life = $max_life;
            $this->life = $life;
            $this->level = $level;
            $this->type = $type;
            $this->strength = $strength;

            static::say_hi();
        }


        public function level_up ()
        {
            $this->level += 1;
            $this->max_life += 5;
            $this->life += 5;
            $this->strength += 2;

            $level_up_text = $this->name . ' passe au niveau ' . $this->level . "\nIl gagne 5 pts de vie et 2 pts de force.\n";

            echo $level_up_text;
            return true;
        }


        public function attack ($pokemon)
        {
            $damages = ceil($this->strength * (rand(900, 1100) / 1000));
            $pokemon->take_damages($damages);
        }


        public function take_damages ($damages)
        {
            $this->life -= $damages;
        }

        public static function say_hi ()
        {
            echo 'Hi !' . "\n";
        }

    }

    $pokemon = new Pokemon('Carapuce', 100, 100, 5, 'eau', 10);