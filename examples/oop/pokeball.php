<?php
    
    class Pokeball 
    {
        public $name;
        public $level;

        public function __construct ($name, $level)
        {
            $this->name = $name;
            $this->level = $level;
        }


        public function catch ($pokemon)
        {
            $succeed_chances = round((($pokemon->max_life - $pokemon->life) / $pokemon->max_life) * (1 + ($this->level - $pokemon->level) / 25), 2);
            
            $random = rand(1, 100) / 100;

            return (bool) ($random <= $succeed_chances);
        }
    }
