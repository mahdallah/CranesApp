<?php
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function isZero($var)
{
    return ($var < 0 ? 0 : $var);
}
// Employee
if ($_GET['table'] == "Employee") {
    if (isset($_POST['submit-btn'])) {
        $table = "Employee";
        $id = $_GET['id'];

        $firstName = validate($_POST['first-name']);
        $middletName = validate($_POST['middle-name']);
        $lastName = validate($_POST['last-name']);
        $position = validate($_POST['position']);
        $salary = validate($_POST['salary']);
        $birthDate = validate($_POST['birth-date']);
        $gender = validate($_POST['gender']);

        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTempName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        $user_data = "id=".$id."&table=".$table."&first-name=" . $firstName . "&middle-name=" . $middletName . "&last-name=" . $lastName . "&position=" . $position . "&salary=" . $salary . "&birth-date=" . $birthDate . "&gender=" . $gender . "&image" . $fileName;

        $isValid = true;
        if (empty($firstName)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=First Name is Required&$user_data");
            exit;
            $isValid = false;
        } else if (empty($middletName)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Middle Name is Required&$user_data");
            exit;
            $isValid = false;
        } else if (empty($lastName)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Last Name is Required&$user_data");
            exit;
            $isValid = false;
        } else if (empty($position)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Position is Required&$user_data");
            exit;
            $isValid = false;
        } else if (empty($salary) || $salary == "0") {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Salary is Required&$user_data");
            exit;
            $isValid = false;
        } else if (empty($birthDate)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Birth Date is Required&$user_data");
            exit;
            $isValid = false;
        } else if ($gender == 0) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Gender is Required&$user_data");
            exit;
            $isValid = false;
        } else if (!empty($fileName) && !in_array($fileActualExt, $allowed)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=image Extention is not valid is Required&$user_data");
            exit;
            $isValid = false;
        } else {
            include "MySql/Includes/dbh.inc.php";
            $fileNameNew = $firstName . uniqid('', true) . "." . $fileActualExt;
            $fileDestniation = 'Images/Employees/' . $fileNameNew;
            move_uploaded_file($fileTempName, $fileDestniation);
            

            $data = "UPDATE `employees` SET `FirstName` = '$firstName', `MiddleName` = '$middletName', `LastName` = '$lastName'
            , `BirthDate` = '$birthDate', `Gender` = '$gender', `Position` = '$position', `Salary` = '$salary', `Image` = '$fileDestniation'
            WHERE `employees`.`Id` = $id;";
            $con->query($data);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . "s.php");
            exit;
        }
    }
    else{
        include("Employee.php");
    }
}
// Customer
if ($_GET['table'] == "Customer") {
    if (isset($_POST['submit-btn'])) {
        $table = "Customer";
        $id = $_GET['id'];
        $firstName = validate($_POST['first-name']);
        $lastName = validate($_POST['last-name']);

        $user_data = "id=".$id."&table=".$table."&first-name=" . $firstName . "&last-name=" . $lastName;

        $isValid = true;
        if (empty($firstName)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=First Name is Required&$user_data");
            exit;
            $isValid = false;
        } else if (empty($lastName)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Last Name is Required&$user_data");
            exit;
            $isValid = false;
        } else {
            include "MySql/Includes/dbh.inc.php";
            $data = "UPDATE `customers` SET `FirstName` = '$firstName', `LastName` = '$lastName' WHERE `customers`.`Id` = $id;";
            $con->query($data);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . "s.php");
            exit;
        }
    }
    else{
        include ("Customer.php");
    }
}
// Crane
else if ($_GET['table'] == "Crane") {
    include("Crane.php");
}
// Quote
else if ($_GET['table'] == "Quote") {
    include ("Quote.php");
}
?>