<?php
	if (isset($_COOKIE['logged'])){
		setcookie("logged", "", time() - 100);
	}	
	header('Location: /');
?>
