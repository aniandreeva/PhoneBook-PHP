<?php
require_once 'header.php';
require_once '/filters/authfilter.php';

if (!$_SESSION["LoggedUserIsAdmin"]) {
    header('Location: contacts.php');
}
?>
<div class="container-center" >
    <div class="wrapper">
    <h2>Users</h2>

        <table>
            <thead>
            <th>Username</th>
            <th>Role</th>
            <th></th>
            </thead>

            <tbody>
            <?php
            require_once '/repositories/users_repository.php';

            $usersRep = new UsersRepository();
            $users = $usersRep->getAll();

            foreach ($users as $u) :
                ?>

                <tr>
                    <td><?= $u->getUsername()?></td>
                    <td><?= $u->getIsAdmin()?"admin":"user"?></td>
                    <td><a href="edit_user.php?id=<?= $u->getId(); ?>">Edit</a></td>
                    <td><a href="delete_user.php?id=<?= $u->getId(); ?>">Delete</a></td>
                </tr>

                <?php
            endforeach;
            ?>

            </tbody>
        </table>
    <a href="add_user.php">Add User</a>
    </div>
</div>

<?php
require_once 'footer.php';
?>