<?php

	try
	{
        $database_host = 'localhost';
        $database_port = '3306';
        $database_dbname = 'test';
        $database_user = 'root';
        $database_password = 'root';
        $database_charset = 'UTF8';
        $database_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        $pdo = new PDO(
            'mysql:host=' . $database_host . 
            ';port=' . $database_port . 
            ';dbname=' . $database_dbname . 
            ';charset=' . $database_charset, 
            $database_user,
            $database_password,
            $database_options
        );

        $query = $pdo->prepare('SELECT id, name FROM user');
        $query->execute();

        $users = $query->fetchAll();
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        exit(1);
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
  </head>
  <body>
    <h1>Liste users</h1>
    <ul>
        <?php
            foreach ($users as $user)
            {
                ?>
                <li><?php echo $user['id']; ?> : <?php echo $user['name']; ></li>
                <?php
            }
        ?>
    </ul>
  </body>
