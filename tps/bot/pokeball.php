<?php
    include_once('./ball.php');

    class Pokeball extends Ball
    {
        public function __construct ()
        {
            $name = 'Pokeball';
            $level = 10;
        
            parent::__construct($name, $level);
        }
    }
