<?php
	function connect_pdo ()
	{
	    $database_host = 'localhost';
	    $database_port = '3306';
	    $database_dbname = 'fortnite_spawn';
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

	    return $pdo;
	}

	function get_spawns ($pdo)
	{
		$query = 'SELECT id, name FROM spawn';
		$query = $pdo->prepare($query);
		$query->execute();

		return $query->fetchAll();
	}

	function get_spawn ($pdo, $id)
	{
		$query = 'SELECT id, name FROM spawn WHERE id = :id';
    	$query = $pdo->prepare($query);
    	$query->execute(['id' => $id]);	

    	return $query->fetch();
	}

	function update_spawn ($pdo, $id, $name)
	{
		$query = 'UPDATE spawn SET name = :name WHERE id = :id';
        $query = $pdo->prepare($query);
        $query->execute(['name' => $name, 'id' => $id]);
	}

	function delete_spawn ($pdo, $id)
	{
		$query = 'DELETE FROM spawn WHERE id = :id';
    	$query = $pdo->prepare($query);
    	$query->execute(['id' => $id]);
	}

	function check_credentials ($pdo, $login, $password)
	{
		$query = 'SELECT id, login FROM user WHERE login = :login AND password = :password';
		$query = $pdo->prepare($query);
		$query->execute([
			'login' => $login,
			'password' => $password,
		]);

		return (bool) $query->fetchAll();
	}

	function insert_spawn ($pdo, $name)
	{
		$query = 'INSERT INTO spawn (name) values (:name)';
        $query = $pdo->prepare($query);
        $query->execute(['name' => $name]);
	}