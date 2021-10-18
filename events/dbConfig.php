<?php 
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "id17388657_calendar_event"; 
$dbPassword = "MJhaynes10MARKh3inz?"; 
$dbName     = "id17388657_calendar"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}