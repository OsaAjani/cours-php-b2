<?php
    include './funcs/datas.php';
    include './funcs/tools.php';

    use_session();
    
    $pdo = connect_pdo();

    if (is_authentified($pdo))
    {
        header('Location: ./home.php');
        exit();
    }


    //Try to connect
    $email = $_POST['email'] ?? false;
    $password = $_POST['password'] ?? false;

    if ($email && $password)
    {
        $user = get_user_by_email($pdo, $email);

        if ($user)
        {
            if (password_verify($password, $user['password']))
            {
                $_SESSION['user'] = $user;
                header('Location: ./home.php');
                exit();
            }
        }
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Connexion</h1>
    <form method="POST" action="">
        <label for="email">Email :</label><br/>
        <input type="email" id="email" name="email" />
        <br/>
        <br/>

        <label for="password">Password :</label><br/>
        <input type="password" id="password" name="password" /><br/>
        <br/>
        <br/>

        <input type="submit" value="Connexion" />
        <br/>
        <br/>

        <a href="./forget_password.php">Mot de passe oublié ? Cliquez ici !</a><br/>
        <a href="./register.php">Pas encore inscrit ? Cliquez ici !</a><br/>

    </form>
</div>

<?php include './incs/footer.php'; ?>
