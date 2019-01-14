<?php
    require './funcs/datas.php';

    $pdo = connect_pdo();

    $_GET['id'] = $_GET['id'] ?? false;


    if ($_GET['id'])
    {
        $query = 'DELETE FROM message WHERE id = ' . $_GET['id'];

        $query = $pdo->prepare($query);
        $query->execute();
    }

    $query = 'SELECT * FROM message';
    $query = $pdo->prepare($query);
    $query->execute();

    $messages = $query->fetchAll();

    foreach ($messages as $message)
    {
    ?>
        id : <?php echo $message['id']; ?> - message : <?php echo $message['message']; ?><br/><br/>
    <?php
    }
