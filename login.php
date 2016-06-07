<?php
require_once '/shared/header.php';
require_once 'filters/userexistfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST') :
	require_once '/repositories/users_repository.php';

	$usersRep = new UsersRepository();

	$username = htmlspecialchars(trim($_POST["username"]));
	$password =  htmlspecialchars(trim($_POST["password"]));

	if (empty($username) || empty($password)) {
		$_SESSION["error"] = "All fields are required!";
		header('Location: login.php');
		exit();
	}else{
		$user = $usersRep->getByUserNameAndPassword($username, $password);

		if (is_null($user)) {
			$_SESSION["error"] = "Wrong username or password!";
			header('Location: login.php');
			exit();
		}

		$_SESSION["LoggedUserUsername"]=$user->getUsername();
		$_SESSION["LoggedUserId"]=$user->getId();
		$_SESSION["LoggedUserIsAdmin"]=$user->getIsAdmin();

		header('Location: index.php');
	}
else:
?>
<div class="container-center" >
	<div class="wrapper">
	<h2>Login</h2>

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
		<input type="submit" class="login" id="submit" value="Login">
	</form>
	</div>
</div>
<?php
	endif;
?>

<?php
require_once '/shared/footer.php';
?>