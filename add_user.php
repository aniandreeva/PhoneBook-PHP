<?php
require_once 'header.php';
require_once '/filters/authfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST'):
    require_once '/repositories/users_repository.php';

    $usersRep = new UsersRepository();

    $user= new User();
    $user->setUsername(htmlspecialchars(trim($_POST['username'])));
    $user->setPassword(htmlspecialchars(trim($_POST['password'])));
    $user->setIsAdmin(intval($_POST['is_admin']));

    $usersRep->insert($user);

    header('Location: users.php');
else:
    ?>
<div class="container-center" >
    <div class="wrapper">
        <h2>Add User</h2>
        <form action="" method="POST" class="form">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" required placeholder="Username" id="username" /><br>
            </div>
            <div class="input-group">
                <label for="password">Username</label>
                <input type="password" name="password" required placeholder="Password" id="password" /><br>
            </div>
            <div class="input-group clear-center">
                <input type="radio" name="is_admin" id="admin" value="1" /><label for="admin">Admin</label><br>
            </div>
            <div class="input-group clear-center">
                <input type="radio" name="is_admin" id="user" value="0" /><label for="user">User</label><br>
            </div>
            <input type="submit" value="Add User" />
        </form>

        <a href="users.php">Back to list</a>
    </div>
</div>
<?php
    endif;
require_once 'footer.php';
?>