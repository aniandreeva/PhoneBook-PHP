<?php
require_once 'header.php';
require_once '/filters/loginfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST'):
    require_once '/repositories/groups_repository.php';

    $groupsRep = new GroupsRepository();

    $group= new Group();
    $group->setUserId($_SESSION["LoggedUserId"]);
    $group->setName(htmlspecialchars(trim($_POST['name'])));

    $groupsRep->insert($group);

    header('Location: groups.php');
else:
    ?>
    <div class="container-center" >
        <div class="wrapper">
            <h2>Add Group</h2>
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
require_once 'footer.php';
?>