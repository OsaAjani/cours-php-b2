<?php
    include './funcs/datas.php';
    include './funcs/tools.php';

    use_session();
    
    $pdo = connect_pdo();

    //Try to connect
    $email = $_POST['email'] ?? false;
    
    if ($email)
    {
        $user = get_user_by_email($pdo, $email);
        if (!$user)
        {
            header('Location: ./');
            exit();
        }

        delete_user_tokens($pdo, $user['id']);

        $token = bin2hex(openssl_random_pseudo_bytes(30));
        $expire = new DateTime();
        $expire->add(new DateInterval('PT01H'));
        
        insert_token($pdo, $user['id'], $token, $expire);

        exit(); 
        $mail = "To reset your cloud password, please go to : " . 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . "/reset_password.php?token=" . $token;
        mail($user['email'], 'Reset password cloud', $mail);
        $send_email = true;
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Mot de passe oublié</h1>

    <?php if (!empty($send_email)) { ?>
        <div>Un email contenant un lien pour reset votre mot de passe vous a été envoyé.</div>
    <?php } else { ?>
        <form method="POST" action="">
            <label for="email">Rentrez l'email pour lequel vous souhaitez reset le password :</label><br/>
            <input type="email" id="email" name="email" />
            <br/>
            <br/>
            <input type="submit" value="Inscription" />
        </form>
    <?php } ?>
</div>

<?php include './incs/footer.php'; ?>
