<?php
require_once 'header.php';
require_once '/filters/loginfilter.php';

if ($_SERVER['REQUEST_METHOD']==='POST'):
    require_once '/repositories/contacts_repository.php';
    require_once '/repositories/contactsGroups_repository.php';

    $contactsRep = new ContactsRepository();
    $contact= new Contact();
    
    $contact->setUser_Id($_SESSION["LoggedUserId"]);
    $contact->setFirst_name(htmlspecialchars(trim($_POST['first_name'])));
    $contact->setLast_name(htmlspecialchars(trim($_POST['last_name'])));
    $contact->setPhone_number(htmlspecialchars(trim($_POST['phone_number'])));

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $uploadOk = true;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check == false) {
        $uploadOk = false;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        $uploadOk = false;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $uploadOk = false;
    }

    $filename = uniqid() . "." . $imageFileType;
    $target_file = "uploads/" . $filename;

    if ($uploadOk) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $contact->setImagePath($filename);
        }
    }
    else {
        $contact->setImagePath("default.jpg");
    }

    $contactsRep->insert($contact);
    $lastid = $contactsRep->getLastId();

    $contactsGroupsRep = new ContactsGroupsRepository();

    $selectedGroups = $_POST['selectedGroups'];
    foreach ($selectedGroups as $selectedGroup) {
        $contactsGroupsRep->insert($selectedGroup, $lastid);
    }

    header('Location: contacts.php');

else:
    require_once '/repositories/groups_repository.php';
    $groupsRep= new GroupsRepository();

    $groups = $groupsRep->getAll();
?>
<div class="container-center" >
    <div class="wrapper">
    <h2>Add Contact</h2>
        <form action="" method="POST" class="form" enctype="multipart/form-data">
            <div class="input-group">
                <img src="uploads/default.jpg">
            </div>
            <div class="input-group">
                <input type="file" name="fileToUpload">
            </div>
            <div class="input-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" required placeholder="First Name..." id="first_name" /><br>
            </div>
            <div class="input-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" required placeholder="Last Name..." id="last_name" /><br>
            </div>
            <div class="input-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" required placeholder="Phone Number..." id="phone_number"/><br>
            </div>
            <div class="input-group clear-center">
                <?php
                    foreach ($groups as $group) :
                ?>
                    <label for="<?= $group->getName(); ?>"> <?= $group->getName(); ?> </label>
                    <input type="checkbox" value="<?= $group->getId(); ?>" name="selectedGroups[]" id="<?=$group->getName(); ?>"><br>
                <?php
                    endforeach;
                ?>
            </div>
            <input type="submit" value="Add Contact" />
        </form>

    <a href="contacts.php">Back to list</a>
    </div>
</div>
<?php
    endif;
require_once 'footer.php';
?>