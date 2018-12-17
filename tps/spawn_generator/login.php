<?php
	session_name('fortnite_random_spawn');
	session_start();

	include './funcs/datas.php';
	include './funcs/tools.php';

	$login = $_POST['login'] ?? false;
	$password = $_POST['password'] ?? false;

	if ($login && $password)
	{
        $pdo = connect_pdo();
        $user_exist = check_credentials($pdo, $login, $password);
        if ($user_exist)
        {
            $_SESSION['admin'] = true;
        }
    }

    if (!empty($_SESSION['admin']))
    {
        header('Location: ./admin.php');
    }
?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Connexion administration</h1>
    <form method="POST" action="">
        <label>
            Login :<br/>
            <input type="text" name="login" />
        </label>
        <br/>
        <br/>
        <label>
            Password :<br/>
            <input type="password" name="password" />
        </label>
        <br/>
        <br/>
        <input type="submit" value="Connexion" />
    </form>
</div>

<?php include './incs/footer.php'; ?>
