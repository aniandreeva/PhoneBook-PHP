<?php
session_start();
require_once '/filters/loginfilter.php';

require_once 'repositories/groups_repository.php';

$groupsRep= new GroupsRepository();
$groupsRep->delete($_GET['id']);

header('Location: groups.php');