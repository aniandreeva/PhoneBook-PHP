<?php
require_once '/shared/header.php';
require_once '/repositories/users_repository.php';
require_once '/filters/authfilter.php';

    $usersRep= new UsersRepository();
    $user=$usersRep->getById($_GET['id']);

    if ($user == NULL) {
        header('Location: add_user.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD']==='POST'):
        $username = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars(trim($_POST['password']));
        $isAdmin = intval($_POST['is_admin']);

        if (empty($username)) {
            $_SESSION["error"] = "Username is required!";
            header('Location: edit_user.php?id=' . $user->getId());
            exit();
        }

        $user->setUsername($username);
        $user->setIsAdmin($isAdmin);

        if (!empty($password)) {
            $user->setPassword($password);
        }

        $usersRep->update($user);

        header('Location: users.php');

     else:
?>
 <div class="container-center" >
     <div class="wrapper">
         <h2>Edit User</h2>

         <?php require_once '/shared/error_message.php' ?>

        <form action="" method="POST" class="form">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" required placeholder="Username" id="username" value="<?=$user->getUsername();?>"><br>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" id="password" /><br>
            </div>
            <div class="input-group clear-center">
                <input type="radio" name="is_admin" id="admin" value="1" <?= $user->getIsAdmin() == '1' ? "checked" : ""; ?> /><label for="admin">Admin</label><br>
            </div>
            <div class="input-group clear-center">
                <input type="radio" name="is_admin" id="user" value="0" <?= $user->getIsAdmin() == '0' ? "checked" : ""; ?> /><label for="user">User</label><br>
            </div>

            <input type="submit" value="Save changes" />
        </form>
         <a href="users.php">Back to list</a>
     </div>
 </div>

<?php
    endif;
require_once '/shared/footer.php';
?>