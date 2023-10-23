<?php
include "MySql/Includes/dbh.inc.php";
echo $id = $_GET['id'];
echo $table = $_GET['table']."s";
$q = "DELETE FROM `$table` WHERE `$table`.`Id` = $id";
mysqli_query($con, $q);
header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/$table.php");
exit;
?>