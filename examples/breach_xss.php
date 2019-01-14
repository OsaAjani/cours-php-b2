<?php
    //...
?>
<?php if (!empty($_GET['error'])) { ?>
    <div style="background-color: red; color: white; font-weight: bold;"><?php echo $_GET['error']; ?></div>
<?php } ?>
<form action="" method="POST">
    Password : <input type="password" name="password"/><br/>
    <input type="submit" value="Connexion"/>
</form>
