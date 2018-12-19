<?php
    include './funcs/datas.php';
    include './funcs/tools.php';
    
    use_session();

    $pdo = connect_pdo();

    $user = is_authentified($pdo);

    if (!$user || !$user['admin'])
    {
        header('Location: ./login.php');
        exit();
    }

    $user_id = $_GET['user_id'] ?? false;
    if (!$user_id)
    {
        header('Location: ./admin.php');
        exit();
    }

    $target_user = get_user($pdo, $user_id);
    if (!$target_user)
    {
        header('Location: ./admin.php');
        exit();
    }

    $target_user_files = get_user_public_files($pdo, $target_user['id']);
?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Fichiers public de <?php echo $target_user['email']; ?></h1>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Lien</th>
            <th>Action</th>
        </tr>

        <?php foreach ($target_user_files as $target_user_file) { ?>
            <tr>
                <td>
                    <?php echo $target_user_file['name']; ?>
                </td>

                <td>
                    <a target="_blank" href="./api/public_download.php?public_uid=<?php echo $target_user_file['public_uid']; ?>">Télécharger</a>
                </td>

                <td>
                    <a href="./admin_delete_file.php?file_id=<?php echo $target_user_file['id'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br/>
    <br/>
    <a href="./admin.php">🠐 Retour à l'administration.</a>
</div>

<?php include './incs/footer.php'; ?>
