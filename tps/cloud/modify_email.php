<?php
    include './funcs/datas.php';
    include './funcs/tools.php';
    
    use_session();

    $pdo = connect_pdo();

    $user = is_authentified($pdo);

    if (!$user)
    {
        header('Location: ./login.php');
        exit();
    }

    $email = $_POST['email'] ?? false;
    if ($email)
    {
        $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$valid_email)
        {
            header('Location: ./account.php');
            exit();
        }

        set_user_email($pdo, $user['id'], $email);

        $user = get_user($pdo, $user['id']);
        $_SESSION['user'] = $user;
        
        header('Location: ./account.php');
        exit();
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Update email</h1>
    <form method="POST" action="">
        <label for="email">Votre nouveau email :</label><br/>
        <input type="email" id="email" name="email" />
        <br/>
        <br/>


        <input type="submit" value="Mettre à jour" />
    </form>
</div>

<?php include './incs/footer.php'; ?>
