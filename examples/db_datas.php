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

        $id = 1;

        $query = $pdo->prepare('SELECT * FROM user WHERE id > :id');
	$query->execute(['id' => $id]);

        $users = $query->fetchAll();

        var_dump($users);

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
    <?php echo "Bonjour le monde !"; ?>
  </body>
