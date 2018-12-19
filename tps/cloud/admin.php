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

    $users = get_users($pdo);
?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Les utilisateurs</h1>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>

        <?php foreach ($users as $user) { ?>
            <tr>
                <td>
                    <?php echo $user['email']; ?>
                </td>

                <td>
                    <?php echo $user['admin'] ? 'Oui' : 'Non'; ?>
                </td>

                <td>
                    <a href="./user_public_files.php?user_id=<?php echo $user['id']; ?>">Voir fichiers publiques</a>
                     - 
                    <a href="./admin_delete_user.php?user_id=<?php echo $user['id']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br/>
    <br/>
    <a href="./home.php">🠐 Retour aux fichiers.</a>
</div>

<?php include './incs/footer.php'; ?>
