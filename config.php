<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sas";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$ROOT = 'http://localhost:90/SAS';

date_default_timezone_set('Asia/Karachi');

?>