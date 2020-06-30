<?php
    $dsn = 'mysql:host=localhost;dbname=test';
    $pdo = new PDO($dsn, 'root', 'ZloiGoroh1999_09_07');
	$query1 = $pdo->query('SELECT COUNT(*) as count FROM `tasks1`');
	$counter = $query1->fetch(PDO::FETCH_OBJ);			//counts how many tasks are in the DB
						
?>

