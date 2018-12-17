<?php
	session_name('fortnite_random_spawn');
	session_start();

	include './funcs/datas.php';
	include './funcs/tools.php';

    if (empty($_SESSION['admin']))
    {
        header('Location: ./login.php');
        exit();
    }
    
    $id = $_GET['id'] ?? false;

    if ($id === false)
    {
        header('Location: ./admin.php');
        exit();
    }

    $pdo = connect_pdo();
    delete_spawn($pdo, $id);

    header('Location: ./admin.php');
    exit();
