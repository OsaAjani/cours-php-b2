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
    <h1>Upload un fichier</h1>
    <form method="POST" enctype="multipart/form-data" action="./api/upload.php?redirect=1">
        <label for="file">Votre fichier :</label><br/>
        <input type="file" id="file" name="file" />
        <br/>
        <br/>
        <input type="submit" value="Envoyer le fichier" />
    </form>
    <br/>
    <br/>
    <a href="./home.php">🠐 Retour aux fichiers.</a>

</div>

<?php include './incs/footer.php'; ?>
