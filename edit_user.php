<?php
require_once 'header.php';
require_once '/repositories/users_repository.php';
require_once '/filters/authfilter.php';

    $usersRep= new UsersRepository();
    $user=$usersRep->getById($_GET['id']);

    if ($user == NULL) {
        header('Location: add_user.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD']==='POST'):
        $password = htmlspecialchars(trim($_POST['password']));
        $user->setUsername(htmlspecialchars(trim($_POST['username'])));
        $user->setIsAdmin(intval($_POST['is_admin']));

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
        <form action="" method="POST" class="form">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" required placeholder="Username" id="username" value="<?=$user->getUsername();?>"><br>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required placeholder="Password" id="password" /><br>
            </div>
            <div class="input-group clear-center">
                <input type="radio" name="is_admin" id="admin" value="admin" <?= $user->getIsAdmin() == '1' ? "checked" : ""; ?> /><label for="admin">Admin</label><br>
            </div>
            <div class="input-group clear-center">
                <input type="radio" name="is_admin" id="user" value="user" <?= $user->getIsAdmin() == '0' ? "checked" : ""; ?> /><label for="user">User</label><br>
            </div>

            <input type="submit" value="Save changes" />
        </form>
         <a href="users.php">Back to list</a>
     </div>
 </div>

<?php
    endif;
require_once 'footer.php';
?>