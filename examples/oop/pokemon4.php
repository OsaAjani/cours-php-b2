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
    }

    $pokemon = new Pokemon('Carapuce', 100, 5, 'eau', 10);