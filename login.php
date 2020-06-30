<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="container input-container">
			<div class="login-form">
				<form method="post">
					<div class="input-login">
						Login <input type="text" name="login">
					</div>
					<div class="input-password">
						Password <input type="password" name="password">
					</div>
					<button type="submit">Log in</button>
				</form>
<?php 
	if ($_POST['login']=='admin' and $_POST['password']=='123'){
		setcookie("logged", TRUE);
		header('Location: /');
	} elseif($_POST['password'] or $_POST['login']){
		echo '<script>alert ("There is no such user or password is wrong");</script>';
	}
?>
			</div>
		</div>		
	</body>
</html>
