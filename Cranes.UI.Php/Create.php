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

        $user_data = "first-name=" . $firstName . "&middle-name=" . $middletName . "&last-name=" . $lastName . "&position=" . $position . "&salary=" . $salary . "&birth-date=" . $birthDate . "&gender=" . $gender . "&image" . $fileName;

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
            $data = "INSERT INTO `employees` (`Id`, `FirstName`, `MiddleName`, `LastName`, `BirthDate`, `Gender`, `Position`, `Salary`, `Image`) 
            VALUES (NULL, '$firstName', '$middletName', '$lastName', '$birthDate', '$gender', '$position', '$salary', '$fileDestniation');";
            $con->query($data);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . "s.php");
            exit;
        }
    }
}
// Customer
if ($_GET['table'] == "Customer") {
    if (isset($_POST['submit-btn'])) {
        $table = "Customer";

        $firstName = validate($_POST['first-name']);
        $lastName = validate($_POST['last-name']);

        $user_data = "first-name=" . $firstName . "&last-name=" . $lastName;

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
            $data = "INSERT INTO `customers` (`Id`, `FirstName`, `LastName`) 
            VALUES (NULL, '$firstName', '$lastName');";
            $con->query($data);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . "s.php");
            exit;
        }
    }
}
// Crane
else if ($_GET['table'] == "Crane") {
    if (isset($_POST['submit-btn'])) {
        $table = "Crane";
        //
        $name = validate($_POST['name']);
        $MaxWeightLiftInTon = validate($_POST['max-weight-lift-in-ton']);
        $pricePerHour = validate($_POST['price-per-hour']);
        $pricePerItem = validate($_POST['price-per-item']);
        $plate = validate($_POST['plate']);

        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTempName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        $user_data = "name=" . $name . "&max-weight-lift-in-ton=" . $MaxWeightLiftInTon . "&price-per-hour=" . $pricePerHour . "&price-per-item=" . $pricePerItem . "&plate=" . $plate . "&image" . $fileName;

        $isValid = true;
        if (empty($name)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Name is Required&$user_data");
            exit;
            $isValid = false;
        } else if (!empty($fileName) && !in_array($fileActualExt, $allowed)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=image Extention is not valid is Required&$user_data");
            exit;
            $isValid = false;
        } else {
            include "MySql/Includes/dbh.inc.php";
            $fileNameNew = $name . uniqid('', true) . "." . $fileActualExt;
            $fileDestniation = 'Images/Cranes/' . $fileNameNew;
            move_uploaded_file($fileTempName, $fileDestniation);
            $data = "INSERT INTO `cranes` (`Id`, `Name`, `MaxWeightLiftInTon`, `PricePerHour`, `PricePerItem`, `Plate`, `Image`)
            VALUES (NULL, '$name', '$MaxWeightLiftInTon', '$pricePerHour', '$pricePerItem', '$plate',  '$fileDestniation');";
            $con->query($data);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . "s.php");
            exit;
        }
    }
}
// Quote
else if ($_GET['table'] == "Quote") {
    if (isset($_POST['submit-btn'])) {
        $table = "Quote";

        $customer_Id = $_POST['customer-id'];
        $crane_Id = $_POST['crane-id'];
        $radioButton = $_POST['is-for-hours-items'];
        $hiredHours = $_POST['hired-hours'];
        $hiredItems = $_POST['hired-items'];
        $discount = isZero($_POST['discount']);

        $user_data = "customer-id=" . $customer_Id .
            "&crane-id=" . $crane_Id .
            "&hired-hours=" . $hiredHours .
            "&hired-items=" . $hiredItems .
            "&discount=" . $discount;

        if ($customer_Id == 0) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Customer is Required&$user_data");
            exit;
        } else if ($crane_Id == 0) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Crane is Required&$user_data");
            exit;
        } else if ($radioButton == "hours" && empty($hiredHours)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Hours shold be givin &$user_data");
            exit;
        } else if ($radioButton == "hours" && $hiredHours < 4) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=invalid hours &$user_data");
            exit;
        } else if ($radioButton == "items" && empty($hiredItems)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=Items shold be givin &$user_data");
            exit;
        } else if ($radioButton == "items" && $hiredItems <= 0) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . ".php?error=invalid items &$user_data");
            exit;
        } else {
            include "MySql/Includes/dbh.inc.php";
            $discountRate = $discount / 100;
            $price = 0;
            if ($radioButton == "hours") {
                $hiredItems = null;
                $q = "SELECT cranes.PricePerHour FROM cranes WHERE Id = $crane_Id";
                $result = $con->query($q);
                $row = mysqli_fetch_assoc($result);
                $pricePerHour = $row['PricePerHour'];
                $price = $pricePerHour * $hiredHours;
            }
            if ($radioButton == "items") {
                $hiredHours = null;
                $q = "SELECT cranes.PricePerItem FROM cranes WHERE Id = $crane_Id";
                $result = $con->query($q);
                $row = mysqli_fetch_assoc($result);
                $pricePerItem = $row['PricePerItem'];
                $price = $pricePerItem * $hiredItems;
            }
            $total = $price - ($discountRate * $price);
            $data = "INSERT INTO `quotes` (`Id`, `Customer_Id`, `Crane_Id`, `HiredHours`, `HiredItems`, `Discount`, `Total`) 
            VALUES (NULL, '$customer_Id', '$crane_Id', '$hiredHours', '$hiredItems', '$discount', '$total');";
            $con->query($data);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php_projects/Hijaz/" . $table . "s.php");
            exit;
        }
    }
}
?>