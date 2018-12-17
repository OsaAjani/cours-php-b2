<?php
    include_once('./ball.php');

    class Masterball extends Ball
    {
        public $name;
        public $level;

        public function __construct ()
        {
            $this->name = 'Masterball';
            $this->level = 1;
        
            parent::__construct($this->name, $this->level);
        }

        protected function try_catch ($pokemon)
        {
            return true;
        }
    }
