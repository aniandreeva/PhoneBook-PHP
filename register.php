<!DOCTYPE HTML>
<html>
<head>
	<title>PhoneBook</title>
</head>
<body>
<?php
require_once 'header.php';
//require_once 'filters/authfilter.php';
require_once  'filters/userexistfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST') :
	require_once '/repositories/users_repository.php';

	$usersRep = new UsersRepository();

	$username = htmlspecialchars(trim($_POST["username"]));
	$password = htmlspecialchars(trim($_POST["password"]));
	$repassword = htmlspecialchars(trim($_POST["repassword"]));

	if ($password!==$repassword) {
		header('Location: register.php');
		echo "Passwords do not match";
		exit();
	}

	if (empty($username) || empty($password) || empty($repassword)) {
		header('Location: register.php');
		echo "All fields are require";
		exit();
	}

	$user = new User();
	$user->setUsername($username);
	$user->setPassword($password);
	$user->setIsAdmin(false);

	$usersRep->insert($user);

	header('Location: login.php');
else:
	?>
	<div class="container-center">
		<div class="wrapper">
<!--			<a href="#" id="login-close">X</a>-->
		<h2>Register</h2>
		<form action="" method="POST" class="form">
			<div class="input-group">
				<label for="username">Username:</label>
				<input type="text" name="username" required id="username"> <br>
			</div>
			<div class="input-group">
				<label for="password">Password:</label>
				<input type="password" name="password" required id="password"> <br>
			</div>
			<div class="input-group">
				<label for="repassword">Re-Password:</label>
				<input type="password" name="repassword" required id="repassword"> <br>
			</div>
			<input type="submit" id="submit" value="Register">
		</form>
		</div>
	</div>
<?php
	endif;
require_once 'footer.php';
?>
</body>
</html>
