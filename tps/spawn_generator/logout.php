<?php
	session_name('fortnite_random_spawn');
	session_start();

    session_destroy();

    header('Location: ./index.php');
    exit();