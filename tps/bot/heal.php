<?php
    include_once('./usable.php');

    abstract class Heal implements Usable
    {
        public $name;
        public $heal;

        public function __construct ($name, $heal)
        {
            $this->name = $name;
            $this->heal = $heal;
        }

        public function use ($pokemon)
        {
            echo $this->name . ' lancée sur ' . $pokemon->name . '...';

            $this->heal = $pokemon->heal($this->heal);

            echo ' ' . $this->heal . 'PV rendus.' . "\n";
            return true;
        }
    }
