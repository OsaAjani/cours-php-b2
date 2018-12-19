<?php

    //Pokemon
    include('./carapuce.php');
    include('./salameche.php');
    include('./bulbizarre.php');

    //Potion
    include('./potion.php');
    include('./superpotion.php');
    include('./hyperpotion.php');
    include('./potionmax.php');

    //Balls
    include('./pokeball.php');
    include('./superball.php');
    include('./hyperball.php');
    include('./masterball.php');

    //Bot
    include('./bot.php');

    ob_start();

    $nb_of_captures = 0;
    $iteration = 100000;
    for ($i = 0 ; $i < $iteration ; $i++)
    {
        $carapuce = new Carapuce(50);
        $salameche = new Salameche(50);

        //Create our bag
        $bag = [];
        $bag[] = new Potion();
        $bag[] = new Potion();
        $bag[] = new Superpotion();
        $bag[] = new Pokeball();
        $bag[] = new Pokeball();
        $bag[] = new Pokeball();

        //Create our bot
        $bot = new Bot($carapuce, $salameche, $bag);

        $my_turn = (bool) rand(0,1);
        
        $end = false;
        while (!$end)
        {
            //Play turn
            if ($my_turn)
            {
                $capture_success = $bot->play();
                if ($capture_success)
                {
                    $nb_of_captures ++;
                    $end = true;
                }
            }
            else
            {
                $damages = $salameche->attack($carapuce);
            }


            //Check if we are dead or we kill enemy
            if ($carapuce->is_dead())
            {
                $end = true;
            }
            
            if ($salameche->is_dead())
            {
                $end = true;
            }

            $my_turn = !$my_turn;
        }

    }

    ob_end_clean();
    ob_end_flush();

    echo 'Taux de capture : ' . $nb_of_captures  . '/' .  $iteration . ' = ' . ($nb_of_captures / $iteration * 100) . '%';
