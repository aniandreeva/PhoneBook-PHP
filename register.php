<?php
require_once '/shared/header.php';
require_once  '/filters/userexistfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST') :
	require_once '/repositories/users_repository.php';

	$usersRep = new UsersRepository();

	$username = htmlspecialchars(trim($_POST["username"]));
	$password = htmlspecialchars(trim($_POST["password"]));
	$repassword = htmlspecialchars(trim($_POST["repassword"]));

	if ($password!==$repassword) {
		$_SESSION["error"] = "Passwords do not match!";
		header('Location: register.php');
		exit();
	}

	if (empty($username) || empty($password) || empty($repassword)) {
		$_SESSION["error"] = "All fields are required!";
		header('Location: register.php');
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
		<h2>Register</h2>

		<?php require_once '/shared/error_message.php' ?>

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
require_once '/shared/footer.php';
?>
</body>
</html>
