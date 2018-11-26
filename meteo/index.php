<?php
	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Météo - Accueil</title>
    <style>
	    <?php
	    	$now = new DateTime();
	    	if ($now->format('H') >= 7 && $now->format('H') < 19)
	    	{
	   			?>
	   			html {
	   				color: #000;
	   				background-color: #fff;
	   			}
	   			<?php
	    	}
	    	else
	    	{
	    		?>
	    		html {
	    			color: #fff;
	    			background-color: #1f263b;
	    		}
	    		<?php
	    	}
	    ?>
	</style>
  </head>
  <body>
  	<h3>
  		Bienvenu, nous sommes le <strong><?php echo strftime('%A %e %B %Y'); ?></strong>
  	</h3>

  	<p>De quelle ville souhaitez-vous connaitre la météo ?</p>
  	<ul>
  		<li><a href="./paris.php">Paris</a></li>
  		<li><a href="./bordeaux.php">Bordeaux</a></li>
  	</ul>
  </body>
</html>