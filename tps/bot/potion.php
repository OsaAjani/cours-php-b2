<?php
    include_once('./heal.php');

    class Potion extends Heal
    {
        public function __construct ()
        {
            $name = 'Potion';
            $heal = 20;
        
            parent::__construct($name, $heal);
        }
    }
