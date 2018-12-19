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

    $files = get_user_files ($pdo, $user['id']);
?>
<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1>Vos fichiers</h1>
    <div><a href="./upload.php">Envoyer un fichier</a></div><br/>
    <?php if (!$files) { ?>
        <div>Vous n'avez pas encore de fichiers.</div>
    <?php } else { ?>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Télécharger</th>
                <th>Lien public</th>
                <th>Action</th>
            </tr>

            <?php foreach ($files as $file) { ?>
                <tr>
                    <td>
                        <?php echo $file['name']; ?>
                    </td>

                    <td>
                        <a target="_blank" href="./api/download.php?uid=<?php echo $file['uid']; ?>">Télécharger</a>
                    </td>

                    <?php if (!$file['public_uid']) { ?>
                        <td>
                            Pas de lien public disponible.
                        </td>
                    <?php } else { ?>
                        <td>
                            <a target="_blank" href="./api/public_download.php?public_uid=<?php echo $file['public_uid']; ?>">Télécharger</a>
                        </td>
                    <?php } ?>

                    <td>
                        <a href="./api/delete.php?redirect=1&uid=<?php echo $file['uid'] ?>">Supprimer</a>
                         - 
                        <?php if (!$file['public_uid']) { ?>
                            <a href="./api/make_public.php?redirect=1&uid=<?php echo $file['uid'] ?>">Rendre public</a>
                        <?php } else { ?>
                            <a href="./api/make_private.php?redirect=1&uid=<?php echo $file['uid'] ?>">Rendre privé</a>

                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</div>

<?php include './incs/footer.php'; ?>
