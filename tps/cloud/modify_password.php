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

    $password = $_POST['password'] ?? false;
    if ($password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        set_user_password($pdo, $user['id'], $hashed_password);

        $user = get_user($pdo, $user['id']);
        $_SESSION['user'] = $user;

        header('Location: ./account.php');
        exit();
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Update password</h1>
    <form method="POST" action="">
        <label for="password">Votre nouveau password :</label><br/>
        <input type="password" id="password" name="password" />
        <br/>
        <br/>


        <input type="submit" value="Mettre à jour" />
    </form>
</div>

<?php include './incs/footer.php'; ?>
