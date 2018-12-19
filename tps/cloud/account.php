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

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Votre compte</h1>
    <div>
        <div>
            Email : <?php echo $user['email']; ?><br/>
            <a href="./modify_email.php">Modifier</a>
        </div><br/> 
        <div>
            Clef API : <?php echo $user['api_key']; ?><br/>
            <a href="./regenerate_api_key.php">Re-générer</a>
        </div><br/>
        <div>
            Mot de passe : *********<br/>
            <a href="./modify_password.php">Modifer</a>
        </div><br/><br/>
        <div>
            Supprimer compte : <br/>
            <a href="./delete_account.php">Cliquez ici pour supprimer ce compte.</a>
        </div><br/><br/>

    </div>
    <br/>
    <br/>
    <a href="./home.php">🠐 Retour aux fichiers.</a>
</div>

<?php include './incs/footer.php'; ?>
