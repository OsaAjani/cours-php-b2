<?php
    
    class Pokemon 
    {
    	public $name;
    	public $life;
    	public $level;
    	public $type;
    	public $strength;

    	public function __construct ($name, $life, $level, $type, $strength)
    	{
    		$this->name = $name;
    		$this->life = $life;
    		$this->level = $level;
    		$this->type = $type;
    		$this->strength = $strength;
    	}


        public function level_up ()
        {
            $this->level += 1;
            $this->life += 5;
            $this->strength += 2;

            $level_up_text = $this->name . ' passe au niveau ' . $this->level . "\nIl gagne 5 pts de vie et 2 pts de force.\n";

            echo $level_up_text;
            return true;
        }
    }

    $pokemon = new Pokemon('Carapuce', 100, 5, 'eau', 10);
    $pokemon2 = clone $pokemon;
    $pokemon2->level_up();
    $pokemon->level_up();

    var_dump($pokemon2);