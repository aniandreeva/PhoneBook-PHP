<?php
require_once 'header.php';
require_once '/repositories/groups_repository.php';
require_once '/filters/loginfilter.php';

$groupsRep= new GroupsRepository();
$group= $groupsRep->getById($_GET['id']);

if ($group == NULL) {
    header('Location: add_group.php');
    exit();
}
if ($group->getUserId()!=$_SESSION["LoggedUserId"]){
    header('Location: groups.php');
}

if ($_SERVER['REQUEST_METHOD']==='POST'):
    $group->setName(htmlspecialchars(trim($_POST['name'])));

    $groupsRep->update($group);

    header('Location: groups.php');

else:
    ?>
    <div class="container-center" >
        <div class="wrapper">
            <h2>Edit Group</h2>
            <form action="" method="POST" class="form">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required placeholder="Name" value="<?= $group->getName() ?>" id="name" /><br>
                </div>
                <input type="submit" value="Edit Group" />
            </form>

            <a href="groups.php">Back to list</a>
        </div>
    </div>
    <?php
endif;
require_once 'footer.php';
?>