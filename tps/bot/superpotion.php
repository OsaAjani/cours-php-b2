<?php
    include_once('./heal.php');

    class Superpotion extends Heal
    {
        public function __construct ()
        {
            $name = 'Superpotion';
            $heal = 50;
        
            parent::__construct($name, $heal);
        }
    }
