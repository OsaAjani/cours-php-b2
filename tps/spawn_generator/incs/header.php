<div id="header">
	<?php if (!empty($_SESSION['admin'])) { ?>
		<a href="./logout.php">Déconnexion</a>
	<?php } else { ?>
		<a href="./login.php">Connexion Admin</a>
	<?php } ?>
</div>
