<?php
	$users = [
		['id' => 1, 'name' => 'Bernard'],
		['id' => 2, 'name' => 'Monique'],
		['id' => 3, 'name' => 'Tasoeur'],
	];

	if ($_POST)
	{
		foreach ($_POST['users'] as $user_id)
		{
			echo 'Vous voulez bannir le user avec l\'id : ' . $user_id . '<br/>';
		}
	}
?>
<form action="" method="POST">
	Liste utilisateurs à bannir :<br/>
	<?php
		foreach ($users as $user)
		{
		?>
			<input type="checkbox" name="users[]" value="<?php echo $user['id']; ?>"/> <?php echo $user['name']; ?><br/>
		<?php
		}
	?>

	<input type="submit" value="Bannir !"/>
</form>