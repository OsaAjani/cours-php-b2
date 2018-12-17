<?php
    include_once('./heal.php');

    class Potionmax extends Heal
    {
        public function __construct ()
        {
            $name = 'Potionmax';
            $heal = 99999999;
            parent::__construct($name, $heal);
        }
    }
