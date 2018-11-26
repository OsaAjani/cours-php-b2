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

        $city = $_POST['city'] ?? false;

        if ($city)
        {
            $query = $pdo->prepare('INSERT into adress (city) values (:city)');
            $query->execute(['city' => $city]);
        }

        $query = $pdo->prepare('SELECT id, city FROM adress');
        $query->execute();

        $adresses = $query->fetchAll();
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
    <h1>Créer ville</h1>
    <form action="" method="POST">
        <label>
            Nom de la ville : <input type="text" name="city" />
        </label><br/>
        <input type="submit" value="Creer la ville"/>
    </form>
    <h2>Liste des villes</h2>
    <ul>
        <?php
            foreach ($adresses as $adress)
            {
                ?>
                <li><?php echo $adress['id']; ?> : <?php echo $adress['city']; ?></li>
                <?php
            }
        ?>
    </ul>
  </body>
