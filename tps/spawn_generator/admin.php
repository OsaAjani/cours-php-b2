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
    $spawns = get_spawns($pdo);
?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Administration</h1>

    <a href="./add.php">Ajouter un nouveau spawn.</a><br/><br/>
    <table>
        <tr>
            <th>Nom du spawn</th>
            <th>Image du spawn</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($spawns as $spawn) { ?>
            <tr>
                <td><?php echo $spawn['name']; ?></td>
                <td><img width="75px;" src="./imgs/spawns/<?php echo mb_strtolower(str_replace(' ', '_', $spawn['name'])); ?>.png" /></td>
                <td><a href="./edit.php?id=<?php echo $spawn['id']; ?>">Modifier</a> - <a href="./delete.php?id=<?php echo $spawn['id']; ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php include './incs/footer.php'; ?>
