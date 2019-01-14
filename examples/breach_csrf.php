<?php
    session_start();
    session_name('breach_csrf');

    require './funcs/datas.php';

    $pdo = connect_pdo();

    $id = $_GET['id'] ?? false;
    $password = $_GET['password'] ?? false;

    if ($password === 'password')
    {
        $_SESSION['connect'] = true;
    }

    if (!$id)
    {
        echo 'Pas de ressource.';
        exit();
    }

    if (!$_SESSION['connect'])
    {
        echo 'Pas connecté.';
        exit();
    }

    $query = 'DELETE FROM message WHERE id = :id';

    $query = $pdo->prepare($query);
    $query->execute(['id' => $id]);

