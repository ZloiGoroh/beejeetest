<?php
	require 'config.php';
    $task = htmlspecialchars($_POST['task_text'], ENT_QUOTES);	//getting data from inputs
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);		//and making from html tags
    $email = $_POST['email'];									//special symbols
    if ($name != '' and $email != '' and $task != '' and filter_var($email, FILTER_VALIDATE_EMAIL)){ //looking for empty fields and checking email validation
       	$email = htmlspecialchars($email, ENT_QUOTES);
		$sql ='INSERT INTO tasks1(email, name, task_text) VALUES(:email, :name, :task)'; //creating an SQL request
		$query = $pdo->prepare($sql); 	//preparing string to make sql request
		$query->execute(['email' => $email, 'name' => $name, 'task' => $task]);	//sending requeset to database
		header('Location: /');
	} else {
		echo 'Вернитесь пожалуйста назад и заполните все данные';
	}
?>
