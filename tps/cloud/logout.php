<?php
    include './funcs/datas.php';
    include './funcs/tools.php';
	use_session();

    session_destroy();

    header('Location: ./login.php');
    exit();