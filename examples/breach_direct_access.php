<?php
    require './funcs/datas.php';

    $pdo = connect_pdo();
    
    $id = $_GET['id'] ?? false;
    if (!$id)
    {
        exit();
    }

    $query = 'SELECT * FROM user WHERE id = :id';
    $query = $pdo->prepare($query);
    $query->execute(['id' => $id]);

    $user = $query->fetch();

    var_dump($user);
?>
