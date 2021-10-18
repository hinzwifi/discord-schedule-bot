<?php
include_once 'config/Database.php';
include_once 'class/Records.php';

$database = new Database();
$db = $database->getConnection();

$record = new Records($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$record->listRecords();
}


if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {
	$monthly = $_POST["usermonth"] + 1;
	$record->username = $_POST["username"];
    $record->surname = $_POST["surname"];
    $record->usernumber = $_POST["usernumber"];
	$record->useryear = $_POST["useryear"];
	$record->userbday = $monthly."-".$_POST["userday"];

	$record->addRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$record->id = $_POST["id"];
	$record->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	
	$record->id = $_POST["id"];
	$monthly = $_POST["usermonth"] + 1;
	$record->username = $_POST["username"];
    $record->surname = $_POST["surname"];
    $record->usernumber = $_POST["usernumber"];
	$record->useryear = $_POST["useryear"];
	$record->userbday = $monthly."-".$_POST["userday"];
	
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>