<?php
    include './funcs/datas.php';
    include './funcs/tools.php';

    use_session();
    
    $pdo = connect_pdo();

    //Try to connect
    $token = $_GET['token'] ?? false;
    
    if (!$token)
    {
        exit();
    }


    $token = get_token_by_value($pdo, $token);
    if (!$token)
    {
        echo "Ce jeton n'est pas valide, merci d'en demander un nouveau.";
        exit();
    }


    $token_expire = new DateTime($token['expire']);
    if ($token_expire < new DateTime())
    {
        echo "Ce jeton n'est pas valide, merci d'en demander un nouveau.";
        exit();
    }


    $user = get_user($pdo, $token['user_id']);
    if (!$user)
    {
        echo "Ce jeton n'est pas valide, merci d'en demander un nouveau.";
        exit();
    }


    $password = $_POST['password'] ?? false;
    if ($password)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        set_user_password($pdo, $user['id'], $password_hash);
    
        delete_user_tokens($pdo, $user['id']);

        header('Location: ./login.php');
        exit();
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Changer mot de passe</h1>

    <form method="POST" action="">
        <label for="password">Nouveau mot de passe:</label><br/>
        <input type="password" id="password" name="password" />
        <br/>
        <br/>
        <input type="submit" value="Mettre à jour" />
    </form>
</div>

<?php include './incs/footer.php'; ?>
