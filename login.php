<?php
require_once 'header.php';
require_once 'filters/userexistfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST') :
	require_once '/repositories/users_repository.php';

	$usersRep = new UsersRepository();

	$username = htmlspecialchars(trim($_POST["username"]));
	$password =  htmlspecialchars(trim($_POST["password"]));

	if (empty($username) || empty($password)) {
		header('Location: login.php');
		exit();
	}else{
		$user = $usersRep->getByUserNameAndPassword($username, $password);

		if (is_null($user)) {
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
<!--		<a href="#" id="login-close">X</a>-->
	<h2>Login</h2>

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
require_once 'footer.php';
?>