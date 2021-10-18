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
	
	$record->subject = $_POST["subject"];
    $record->subjectT = $_POST["subjectT"];
    $record->meetLink = $_POST["meetLink"];
	$record->meetSched = $_POST["meetSched"];
	$record->meetDay = $_POST["meetDay"];

	$record->addRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$record->id = $_POST["id"];
	$record->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	
	$record->id = $_POST["id"];
	
	$record->subject = $_POST["subject"];
    $record->subjectT = $_POST["subjectT"];
    $record->meetLink = $_POST["meetLink"];
	$record->meetSched = $_POST["meetSched"];
	$record->meetDay = $_POST["meetDay"];
	
	$record->updateRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
?>