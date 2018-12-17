<?php
    include_once('./ball.php');

    class Hyperball extends Ball
    {
        public $name;
        public $level;

        public function __construct ()
        {
            $this->name = 'Hyperball';
            $this->level = 50;
        
            parent::__construct($this->name, $this->level);
        }
    }
