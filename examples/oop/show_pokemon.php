<pre>
<?php
    $step = (int) $_GET['step'] ?? 0;
    $filepath = './pokemon' . $step . '.php';

    if (!file_exists($filepath))
    {
        exit('Not a valid step');
    }

    include $filepath;
    var_dump($pokemon);
?>


</pre>

<?php if ($step) { ?>
    <a href="?step=<?php echo $step - 1; ?>">Prev</a> -
<?php } ?>
<a href="?step=<?php echo $step + 1; ?>">Next</a>
