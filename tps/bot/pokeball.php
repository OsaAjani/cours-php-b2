<?php
    include_once('./ball.php');

    class Pokeball extends Ball
    {
        public $name;
        public $level;

        public function __construct ()
        {
            $this->name = 'Pokeball';
            $this->level = 10;
        
            parent::__construct($this->name, $this->level);
        }
    }
