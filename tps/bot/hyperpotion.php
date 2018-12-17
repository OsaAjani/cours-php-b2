<?php
    include_once('./heal.php');

    class Hyperpotion extends Heal
    {
        public function __construct ()
        {
            $name = 'Hyperpotion';
            $heal = 200;
        
            parent::__construct($name, $heal);
        }
    }
