<?php
    include_once('./ball.php');

    class Superball extends Ball
    {
        public $name;
        public $level;

        public function __construct ()
        {
            $this->name = 'Superball';
            $this->level = 30;
        
            parent::__construct($this->name, $this->level);
        }
    }
