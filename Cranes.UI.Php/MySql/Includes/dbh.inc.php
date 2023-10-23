<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "hijaz";

$con = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
if ($con->connect_error) {
    echo $con->errno;
}
?>