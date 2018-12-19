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
        $valid_password = password_verify($password, $user['password']);
        if (!$valid_password)
        {
            header('Location: ./account.php');
            exit();
        }


        //Delete user files
        $files = get_user_files($pdo, $user['id']);
        foreach ($files as $file)
        {
            delete_user_file($pdo, $user['id'], $file['uid']);

            //If no other files with this hash, delete file from server
            $file_still_exist = get_file_by_uid ($pdo, $file['uid']);
            if (!$file_still_exist)
            {
                unlink('./files/' . $file['uid']);
            }
        }


        //Delete user
        delete_user($pdo, $user['id']);
        unset($_SESSION['user']);
        
        header('Location: ./logout.php');
        exit();
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Supprimer votre compte</h1>
    <div style="color: red;">
        Attention, en supprimant votre compte, tous vos fichiers seront perdus !
    </div>
    <br/>
    <form method="POST" action="">
        <label for="password">Entrez votre mot de passe pour supprimer votre compte :</label><br/>
        <input type="password" id="password" name="password" />
        <br/>
        <br/>

        <input type="submit" value="Supprimer le compte" />
    </form>
    </div>

<?php include './incs/footer.php'; ?>
