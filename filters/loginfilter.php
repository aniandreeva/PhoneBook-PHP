<?php
if (!isset($_SESSION["LoggedUserId"])) {
    header('Location: index.php');
    exit();
}
