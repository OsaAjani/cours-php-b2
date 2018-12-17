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

    $id = $_GET['id'] ?? false;

    $pdo = connect_pdo();

    $spawn = get_spawn($pdo, $id);

    if (!$spawn)
    {
        header('Location: ./admin.php');
        exit();
    }

    $name = $_POST['name'] ?? false;
    if ($name)
    {
        update_spawn($pdo, $id, $name);
        header('Location: ./admin.php');
        exit();
    }

?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Modifier un spawn</h1>
    <a href="./admin.php">Retour</a><br/>
    <br/>
    <form method="POST" action="">
        <label>
            Nom du spawn<br/>
            <input type="text" name="name" value="<?php echo htmlspecialchars($spawn['name']); ?>"/>
        </label>    
    
        <br/>
        <br/>
        <input type="submit" value="Enregistrer" />
    </form>
</div>

<?php include './incs/footer.php'; ?>
