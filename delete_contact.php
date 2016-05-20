<?php
session_start();
require_once '/filters/loginfilter.php';

require_once 'repositories/contacts_repository.php';

$contactsRep= new ContactsRepository();
$contactsRep->delete($_GET['id']);

header('Location: contacts.php');