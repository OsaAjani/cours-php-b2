<?php
	session_name('b2_count_visit_example');
	session_start();

	$_SESSION['count_visit'] = $_SESSION['count_visit'] ?? 0;
	$_SESSION['count_visit'] ++;

	echo 'Vous avez déjà visité cette page ' . $_SESSION['count_visit'] . ' fois.';
