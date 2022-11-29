<?php

$servername = "localhost:3306";
$username = "harsh";
$password = "Roopesh_123";
$dbname = "harsh_report";

$con = mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}