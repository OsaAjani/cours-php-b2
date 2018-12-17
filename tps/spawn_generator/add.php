<?php
	session_name('fortnite_random_spawn');
	session_start();

	include './funcs/datas.php';
	include './funcs/tools.php';

    if (empty($_SESSION['admin']))
    {
        header('Location: ./login.php');
        exit();
    }

    $pdo = connect_pdo();
    
    $name = $_POST['name'] ?? false;
    if ($name)
    {
        insert_spawn($pdo, $name);
        header('Location: ./admin.php');
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Ajouter un spawn</h1>
    <a href="./admin.php">Retour</a><br/>
    <br/>
    <form method="POST" action="">
        <label>
            Nom du spawn<br/>
            <input type="text" name="name"/>
        </label>    
    
        <br/>
        <br/>
        <input type="submit" value="Enregistrer" />
    </form>
</div>

<?php include './incs/footer.php'; ?>
