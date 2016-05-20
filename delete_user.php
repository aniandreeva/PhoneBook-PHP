<?php
session_start();
require_once '/filters/authfilter.php';

require_once '/repositories/users_repository.php';

$usersRep= new UsersRepository();
$usersRep->delete($_GET['id']);

header('Location: users.php');