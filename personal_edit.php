<?php
require_once 'header.php';
require_once '/filters/loginfilter.php';

require_once '/repositories/users_repository.php';

    $usersRep= new UsersRepository();
    $user=$usersRep->getById($_SESSION['LoggedUserId']);

    if ($_SERVER['REQUEST_METHOD']==='POST'):
        $username = htmlspecialchars(trim($_POST["username"]));
        $oldpassword = htmlspecialchars(trim($_POST['oldpassword']));
        $newpassword = htmlspecialchars(trim($_POST['newpassword']));
        $repassword = htmlspecialchars(trim($_POST['repassword']));

        if (!empty($oldpassword) && !empty($newpassword) && !empty($repassword)) {

            if ($oldpassword !== $user->getPassword()) {
                header('Location: personal_edit.php?err=wrongoldpass');
                exit();
            }

            if ($newpassword !== $repassword) {
                header('Location: personal_edit.php?err=newandrepass');
                exit();
            }

            $user->setPassword($newpassword);
        }

        $usersRep->update($user);

        header('Location: users.php');
    else:
        ?>
<div class="container-center" >
    <div class="wrapper">
        <h2>My account</h2>
        <form action="" method="POST" class="form">
            <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" required placeholder="Username" id="username" value="<?= $user->getUsername(); ?>" /><br>
            </div>
            <div class="input-group">
                <label for="oldpassword">Old Password</label>
                <input type="password" name="oldpassword" required placeholder="Old Password" id="oldpassword" /><br>
            </div>
            <div class="input-group">
                <label for="newpassword">New Password</label>
                <input type="password" name="newpassword" required placeholder="New Password" id="newpassword" /><br>
            </div>
            <div class="input-group">
                <label for="repassword">Repeat Password</label>
                <input type="password" name="repassword" required placeholder="Password" id="repassword" /><br>
            </div>
            <input type="submit" value="Save changes" />
        </form>

        <p>Fill password and repeat password only if you want to change it!</p>

        <a href="contacts.php">Back to contacts</a>
    </div>
</div>
<?php
    endif;
require_once 'footer.php';
?>