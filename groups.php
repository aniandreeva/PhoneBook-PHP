
<?php
require_once 'header.php';
require_once '/filters/loginfilter.php';
?>
<div class="container-center" >
    <div class="wrapper">
        <h2>Groups</h2>

        <table>
            <thead>
            <th>Name</th>
            <th>Username</th>
            <th></th>
            </thead>
<?php
    require_once '/repositories/groups_repository.php';
    require_once '/repositories/users_repository.php';

            $groupsRep = new GroupsRepository();
            $usersRep= new UsersRepository();

            if ($_SESSION["LoggedUserIsAdmin"]):
                $groups = $groupsRep->getAll();
            else:
                $groups = $groupsRep->getAllByUserId($_SESSION["LoggedUserId"]);
            endif;

            foreach ($groups as $g) :
                ?>

                <tbody>
                <tr>
                    <td><?= $g->getName()?></td>
                    <td><?=$usersRep->getById($g->getUserId())->getUsername()?></td>
                    <td><a href="edit_group.php?id=<?= $g->getId(); ?>">Edit</a></td>
                    <td><a href="delete_group.php?id=<?= $g->getId(); ?>">Delete</a></td>
                </tr>
                </tbody>

                <?php
            endforeach;
            ?>

        </table>

        <a href="add_group.php" class="left-aligned">Add Group</a>
    </div>
</div>

<?php
require_once 'footer.php';
?>
