<?php
require_once '/shared/header.php';
require_once '/filters/loginfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST'):
    require_once '/repositories/groups_repository.php';

    $groupsRep = new GroupsRepository();

    $name = htmlspecialchars(trim($_POST['name']));

    if (empty($name)) {
        $_SESSION["error"] = "All fields are required!";
        header('Location: add_group.php');
        exit();
    }

    $group= new Group();
    $group->setUserId($_SESSION["LoggedUserId"]);
    $group->setName($name);

    $groupsRep->insert($group);

    header('Location: groups.php');
else:
    ?>
    <div class="container-center" >
        <div class="wrapper">
            <h2>Add Group</h2>

            <?php require_once '/shared/error_message.php' ?>

            <form action="" method="POST" class="form">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required placeholder="Name" id="name" /><br>
                </div>
                <input type="submit" value="Add Group" />
            </form>

            <a href="groups.php">Back to list</a>
        </div>
    </div>
    <?php
endif;
require_once '/shared/footer.php';
?>