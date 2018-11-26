<?php
    $message = $_GET['message'] ?? false;

    if ($message === false || $message === '')
    {
        ?>
        Vous devez fournir un message à afficher.
        <?php
    }
    else
    {
        ?>
        Votre message : <?php echo $message; ?>
        <?php
    }