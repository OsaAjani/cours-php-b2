<?php
	function connect_pdo ()
	{
	    $database_host = 'localhost';
	    $database_port = '3306';
	    $database_dbname = 'cloud';
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


	/*
	 USERS FUNCTIONS
	*/

	function get_user ($pdo, $id)
	{
		$query = 'SELECT id, email, password, admin, api_key FROM user WHERE id = :id';
		$query = $pdo->prepare($query);
		$query->execute(['id' => $id]);

		return $query->fetch();
	}

	function get_users ($pdo)
	{
		$query = 'SELECT id, email, password, admin, api_key FROM user';
		$query = $pdo->prepare($query);
		$query->execute();

		return $query->fetchAll();
	}


	function get_user_by_api_key ($pdo, $api_key)
	{
		$query = 'SELECT id, email, password, admin, api_key FROM user WHERE api_key = :api_key';
		$query = $pdo->prepare($query);
		$query->execute(['api_key' => $api_key]);

		return $query->fetch();
	}


	function get_user_by_email ($pdo, $email)
	{
		$query = 'SELECT id, email, password, admin, api_key FROM user WHERE email = :email';
		$query = $pdo->prepare($query);
		$query->execute(['email' => $email]);

		return $query->fetch();
	}


	function insert_user ($pdo, $email, $password, $api_key)
	{
		$query = '
			INSERT INTO user (email, password, api_key)
			VALUES (:email, :password, :api_key)
		';

		$query = $pdo->prepare($query);
		$query->execute(['email' => $email, 'password' => $password, 'api_key' => $api_key]);
	}


	function set_user_email ($pdo, $user_id, $email)
	{
		$query = '
			UPDATE user
			SET email = :email
			WHERE id = :user_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'email' => $email]);
	}


	function set_user_password ($pdo, $user_id, $password)
	{
		$query = '
			UPDATE user
			SET password = :password
			WHERE id = :user_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'password' => $password]);
	}


	function set_user_api_key ($pdo, $user_id, $api_key)
	{
		$query = '
			UPDATE user
			SET api_key = :api_key
			WHERE id = :user_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'api_key' => $api_key]);
	}


	function delete_user ($pdo, $user_id)
	{
		$query = '
			DELETE FROM user
			WHERE id = :user_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id]);
	}




	/*
	 FILES FUNCTIONS
	*/

	function get_user_files ($pdo, $user_id)
	{
		$query = '
			SELECT id, user_id, name, uid, public_uid
			FROM file
			WHERE user_id = :user_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id]);

		return $query->fetchAll();
	}


	function get_user_public_files ($pdo, $user_id)
	{
		$query = '
			SELECT id, user_id, name, uid, public_uid
			FROM file
			WHERE user_id = :user_id
			AND public_uid != \'\'
			';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id]);

		return $query->fetchAll();
	}


	function get_user_file_by_name ($pdo, $user_id, $name)
	{
		$query = '
			SELECT id, user_id, name, uid, public_uid
			FROM file
			WHERE user_id = :user_id
			AND name = :name
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'name' => $name]);

		return $query->fetch();
	}


	function get_user_file ($pdo, $user_id, $file_uid)
	{
		$query = '
			SELECT id, user_id, name, uid, public_uid
			FROM file
			WHERE user_id = :user_id
			AND uid = :file_uid
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'file_uid' => $file_uid]);

		return $query->fetch();
	}


	function get_file ($pdo, $file_id)
	{
		$query = '
			SELECT id, user_id, name, uid, public_uid
			FROM file
			WHERE id = :file_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['file_id' => $file_id]);

		return $query->fetch();
	}


	function get_file_by_uid ($pdo, $uid)
	{
		$query = '
			SELECT id, user_id, name, uid, public_uid
			FROM file
			WHERE uid = :uid
		';

		$query = $pdo->prepare($query);
		$query->execute(['uid' => $uid]);

		return $query->fetch();
	}


	function get_file_by_public_uid ($pdo, $public_uid)
	{
		$query = '
			SELECT id, user_id, name, uid, public_uid
			FROM file
			WHERE public_uid = :public_uid
		';

		$query = $pdo->prepare($query);
		$query->execute(['public_uid' => $public_uid]);

		return $query->fetch();
	}


	function insert_file ($pdo, $user_id, $name, $uid)
	{
		$query = '
			INSERT INTO file (user_id, name, uid)
			VALUES (:user_id, :name, :uid)
			';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'name' => $name, 'uid' => $uid]);

		return (bool) $query->rowCount();
	}


	function delete_file ($pdo, $file_id)
	{
		$query = '
			DELETE FROM file
			WHERE id = :file_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['file_id' => $file_id]);
	}


	function delete_user_file ($pdo, $user_id, $file_uid)
	{
		$query = '
			DELETE FROM file
			WHERE user_id = :user_id
			AND uid = :file_uid
		';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'file_uid' => $file_uid]);
	}


	function set_file_public_uid ($pdo, $file_id, $public_uid)
	{
		$query = '
			UPDATE file
			SET public_uid = :public_uid
			WHERE id = :file_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['public_uid' => $public_uid, 'file_id' => $file_id]);
	}


	function remove_file_public_uid ($pdo, $file_id)
	{
		$query = '
			UPDATE file
			SET public_uid = NULL
			WHERE id = :file_id
		';

		$query = $pdo->prepare($query);
		$query->execute(['file_id' => $file_id]);
	}



	/* TOKEN FUNCTIONS */
	function insert_token ($pdo, $user_id, $value, $expire)
	{
		$query = '
			INSERT INTO token (user_id, value, expire)
			VALUES (:user_id, :value, :expire)
			';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id, 'value' => $value, 'expire' => $expire->format('Y-m-d H:i:s')]);
	}


	function delete_user_tokens ($pdo, $user_id)
	{
		$query = '
			DELETE FROM token
			WHERE user_id = :user_id
			';

		$query = $pdo->prepare($query);
		$query->execute(['user_id' => $user_id]);
	}


	function get_token_by_value ($pdo, $token_value)
	{
		$query = '
			SELECT id, user_id, value, expire
			FROM token
			WHERE value = :token_value
			';

		$query = $pdo->prepare($query);
		$query->execute(['token_value' => $token_value]);

		return $query->fetch();
	}