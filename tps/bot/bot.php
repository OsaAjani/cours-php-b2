<?php

    class Bot 
    {
        public $bag;
        public $pokemon;
        public $enemy;


        public function __construct ($pokemon, $enemy, $bag)
        {
            $this->pokemon = $pokemon;
            $this->enemy = $enemy;
            $this->bag = $bag;
        }


        public function count_in_bag ($class_name)
        {
            $count = 0;
            foreach ($this->bag as $object)
            {
                if (is_a($object, $class_name))
                {
                    $count ++;
                }
            }

            return $count;
        }


        public function remove_from_bag ($class_name)
        {
            foreach ($this->bag as $key => $object)
            {
                if (is_a($object, $class_name))
                {
                    unset($this->bag[$key]);
                    return true;
                }
            }

            return false;
        }


        public function get_in_bag ($class_name)
        {
            foreach ($this->bag as $key => $object)
            {
                if (is_a($object, $class_name))
                {
                    return $this->bag[$key];
                }
            }

            return false;
        }


        public function calcul_max_damages ($pokemon)
        {
            return ceil($pokemon->strength * (1100 / 1000));
        }


        public function calcul_max_heal ($potion)
        {
            return min(($this->pokemon->max_life - $this->pokemon->life), $potion->heal);
        }


        public function could_kill ($attackant, $attacked)
        {
            $max_deg = $this->calcul_max_damages($attackant);

            if ($max_deg > $attacked->life)
            {
                return true;
            }

            return false;
        }


        public function capture_probability ()
        {
            $pokeball = $this->get_in_bag('Pokeball');
            if (!$pokeball)
            {
                return 0;
            }

            $probability = round((($this->pokemon->max_life - $this->pokemon->life) / $this->pokemon->max_life) * (1 + ($pokeball->level - $this->pokemon->level) / 25), 2);
            $probability = rand(1, 100) / 100;

            return $probability;
        }


        public function try_capture ()
        {
            $pokeball = $this->get_in_bag('Pokeball');

            if (!$pokeball)
            {
                return false;
            }

            $success = $pokeball->use($this->enemy);
            $this->remove_from_bag('Pokeball');

            return $success;
        }


        public function heal ($pokemon, $potion)
        {
            $heal = $potion->use($pokemon);
            $this->remove_from_bag(get_class($potion));

            return $heal;
        }


        public function attack ()
        {
            $damages = $this->pokemon->attack($this->enemy);
            echo $this->pokemon->name . ' attaque ' . $this->enemy->name . ' et inflige ' . $damages . ' dégats.' . "\n";
        }


        public function play ()
        {
            //If we are sure to capture, do it in priority
            if ($this->capture_probability() >= 1)
            {
                return $this->try_capture();
            }
            
            //If we can die in 2 turn or less, check if we can heal
            if ($this->pokemon->life / 2 < $this->calcul_max_damages($this->enemy))
            {
                $potion = $this->get_in_bag('Potion');
                $superpotion = $this->get_in_bag('Superpotion');
                
                //If we have potion, and potion can heal more than enemy damage
                if ($potion && $this->calcul_max_heal($potion) > $this->calcul_max_damages($this->enemy))
                {
                    $this->heal($this->pokemon, $potion);
                    return false;
                }

                //Else, if we have superpotion, and superpotion heal more than enemy damage
                if ($superpotion && $this->calcul_max_heal($superpotion) > $this->calcul_max_damages($this->enemy))
                {
                    $this->heal($this->pokemon, $superpotion);
                    return false;
                }
            }


            //If we can die, try to capture anyway
            if ($this->get_in_bag('Pokeball') && $this->could_kill($this->enemy, $this->pokemon))
            {
                return $this->try_capture();
            }

            //If we risk to kill enemy, we dont attack
            if ($this->get_in_bag('Pokeball') && $this->could_kill($this->pokemon, $this->enemy))
            {
                return $this->try_capture();
            }


            //If we cannot do anything better, we attack
            $this->attack();
            return false;

            //To improve, we could simply try to brute force generate all action and take the best odds. We could just try to check if we can be sure to capture before die, and if not, try to minimize life as quick as possible and use last 3 turn to try capture.
        }
    }
