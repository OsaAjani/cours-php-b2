<pre>
<?php
    include_once './pokemon7.php';
    include_once './carapuce2.php';
    include_once './pokeball.php';


    $pokeball = new Pokeball('pokeball', 10);

    $carapuce = new Carapuce(5);
    $bulbizarre = new Pokemon('Bulbizarre', 70, 70, 5, 'herbe', 15);

    //$carapuce->attack($bulbizarre);
    //$carapuce->attack($bulbizarre);
    $carapuce->attack($bulbizarre);

    $catch_attempt = $pokeball->catch($bulbizarre);

?>
<?php if ($catch_attempt) { ?>
    Bravo, vous avez capturé <?php echo $bulbizarre->name; ?> !
<?php } else { ?>
    Zut ! <?php echo $bulbizarre->name; ?> est sorti de la pokéball !
<?php } ?>
</pre>
