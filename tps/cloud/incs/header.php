<div id="header">
	<?php if (!empty($_SESSION['user'])) { ?>
		<?php if ($_SESSION['user']['admin']) { ?>
            <a href="./admin.php">Administration</a> - 
        <?php } ?>
        <a href="./account.php">Mon compte</a> - <a href="./logout.php">Déconnexion</a>
    <?php } ?>
</div>
