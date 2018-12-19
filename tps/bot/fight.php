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


    //Create our pokemon
    echo "Vous invoquez Carapuce\n";
    $carapuce = new Carapuce(5);

    //Create enemy
    echo "Votre ennemi invoque un Salamche\n";
    $salameche = new Salameche(8);

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

    echo "\n";
    echo "\n";
    echo 'Début du combat !' . "\n";
    echo '-----------------' . "\n";
    echo "\n";

    $my_turn = (bool) rand(0,1);
    
    $end = false;
    while (!$end)
    {
        //Print info for turn
        echo ($my_turn ? 'C\'est à votre tour : ' : 'C\'est au tour de votre adversaire') . "\n";
        echo "Carapuce : " . $carapuce->life . "PV  -  Salameche : " . $salameche->life . "PV\n";


        //Play turn
        if ($my_turn)
        {
            $capture_success = $bot->play();
            if ($capture_success)
            {
                $end = true;
            }
        }
        else
        {
            $damages = $salameche->attack($carapuce);
            echo $salameche->name . ' attaque ' . $carapuce->name . ' et inflige ' . $damages . ' dégats.' . "\n";
        }


        //Check if we are dead or we kill enemy
        if ($carapuce->is_dead() || $salameche->is_dead())
        {
            $end = true;
        }

        echo "\n\n";

        $my_turn = !$my_turn;
    }


    echo '-----------------' . "\n";
    
    if ($capture_success ?? false)
    {
        echo 'Bien joué, vous avez capturez Salameche !' . "\n";
        echo 'Ça c\'était du sacré combat !' . "\n";
    }
    elseif ($carapuce->is_dead())
    {
        echo 'Raté ! Votre Carapuce est KO !' . "\n";
    }
    elseif ($salameche->is_dead())
    {
        echo 'Raté ! Vous avez mis ce pauvre Salameche KO !' . "\n";
    }
    
    echo '-----------------' . "\n";
    echo "\n";
    echo 'Fin du combat !' . "\n";
    echo "\n";

