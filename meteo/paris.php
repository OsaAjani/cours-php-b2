<?php
	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Météo - Paris</title>
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
	    		a {
	    			color: #fff;
	    		}
	    		<?php
	    	}
	    ?>
	</style>
  </head>
  <body>
  	<a href="./index.php">&larr; Retour à l'accueil</a>
  	<h3>
  		À Paris la météo est la suivante :
  	</h3>
  	<?php
  		$i = 0;
  		while ($i <= 4)
  		{
  			?>
  			<div>
	  			<h4>À J+<?php echo $i; ?></h4>
	  			<img src="https://www.prevision-meteo.ch/uploads/widget/paris_<?php echo $i; ?>.png"/>
  			</div>
  			<?php
  			$i++;
  		}
  	?>
  </body>
</html>