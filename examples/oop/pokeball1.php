<?php

    include_once './usable.php';
    
    class Pokeball implements Usable
    {
        public $name;
        public $level;

        public function __construct ($name, $level)
        {
            $this->name = $name;
            $this->level = $level;
        }


        protected function try_catch ($pokemon)
        {
            $succeed_chances = round((($pokemon->max_life - $pokemon->life) / $pokemon->max_life) * (1 + ($this->level - $pokemon->level) / 25), 2);

            $random = rand(1, 100) / 100;

            var_dump($succeed_chances);

            return (bool) ($random <= $succeed_chances);
        }


        public function use ($pokemon)
        {
            echo $this->name . ' lancée sur ' . $pokemon->name . '...';
            
            $catch = $this->try_catch($pokemon);
            
            if (!$catch)
            {
                echo "ko.\n";
                return false;
            }

            echo ' ' . $pokemon->name . ' a été capturé !';
            return true;
        }
    }
