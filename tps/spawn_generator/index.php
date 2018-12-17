<?php
	session_name('fortnite_random_spawn');
	session_start();

	include './funcs/datas.php';
	include './funcs/tools.php';


	if (isset($_SESSION['current_spawn']))
	{
		$_SESSION['previous_spawn'] = $_SESSION['current_spawn'];
	}

	$pdo = connect_pdo();

	$spawns = get_spawns($pdo);
	$rand_key = array_rand($spawns);
	$spawn = $spawns[$rand_key];

	$previous_spawn_exist = isset($_SESSION['previous_spawn']);
	while ($previous_spawn_exist && $spawn['name'] == $_SESSION['previous_spawn']['name'])
	{
		$rand_key = array_rand($spawns);
		$spawn = $spawns[$rand_key];
	}

	$_SESSION['current_spawn'] = $spawn;

?>

<?php include './incs/head.php'; ?>
<?php include './incs/header.php'; ?>

<div class="main">
    <h1><?php echo $spawn['name']; ?></h1>
    <div>
    	<img src="./imgs/spawns/<?php echo mb_strtolower(str_replace(' ', '_', $spawn['name'])); ?>.png"/>
    </div>
    <a href="" class="spawn_button">Tirer un autre spawn</a>
</div>

<?php include './incs/footer.php'; ?>
