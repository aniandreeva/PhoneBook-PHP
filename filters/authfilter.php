<?php
if (isset($_SESSION["LoggedUserId"])) {
    if (!$_SESSION["LoggedUserIsAdmin"]) {
        header('Location: index.php');
        exit();
    }
}
else {
    header('Location: index.php');
    exit();
}