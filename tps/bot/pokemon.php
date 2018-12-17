<?php
    
    abstract class Pokemon 
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


        public function attack ($pokemon)
        {
            $damages = ceil($this->strength * (rand(900, 1100) / 1000));
            return $pokemon->take_damages($damages);
        }


        public function take_damages ($damages)
        {
            $this->life -= $damages;
            return $damages;
        }


        public function heal ($heal)
        {
            $new_life = min($this->life + $heal, $this->max_life);
            $this->life = $new_life;

            return $new_life - $this->life;
        }

        
        public function is_dead ()
        {
            return ($this->life <= 0);
        }

        abstract public function level_up ();
            
        abstract public static function say_hi ();

    }
