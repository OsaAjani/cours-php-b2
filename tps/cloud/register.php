<?php
    include './funcs/datas.php';
    include './funcs/tools.php';

    use_session();
    
    $pdo = connect_pdo();

    //Try to connect
    $email = $_POST['email'] ?? false;
    $password = $_POST['password'] ?? false;

    if ($email && $password)
    {
        $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$valid_email)
        {
            header('Location: ./');
            exit();
        }

        $api_key = bin2hex(openssl_random_pseudo_bytes(30));
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        insert_user ($pdo, $email, $password_hash, $api_key);
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Inscription</h1>
    <form method="POST" action="">
        <label for="email">Email :</label><br/>
        <input type="email" id="email" name="email" />
        <br/>
        <br/>

        <label for="password">Password :</label><br/>
        <input type="password" id="password" name="password" /><br/>
        <br/>
        <br/>

        <input type="submit" value="Inscription" />
        <br/>
        <br/>
    </form>
</div>

<?php include './incs/footer.php'; ?>
