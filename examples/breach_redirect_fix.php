<?php
session_start();
session_name('breach_csrf');

require './funcs/datas.php';

$pdo = connect_pdo();

$password = $_POST['password'] ?? false;
$redirect = $_GET['redirect'] ?? false;

if ($password === 'password')
{
    $_SESSION['connect'] = true;

    if ($redirect)
    {
        $servername = parse_url($redirect, PHP_URL_HOST);

        if ($servername != $_SERVER['REMOTE_HOST'])
        {
            echo 'Bad redirection.';
            exit();
        }

        header('Location: ' . $redirect);
    }
}
?>
<form action="" method="POST">
    Password : <input type="password" name="password" /><br/>
    <input type="submit" value="Connexion" />
</form>

