<?php
$applicationName = "Hijaz Crane Service";
$table = "Employee";
include "./MySql/Includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("Content/Head.php"); ?>
</head>

<body>
    <?php include("Components/Header.php"); ?>
    <?php if ($_GET['id']) {
        $id = $_GET['id'];
        $query = "SELECT * FROM employees where Id = '$id'";
        $result = mysqli_query($con, $query);
        $row  = mysqli_fetch_assoc($result);
        $firstName = $row['FirstName'];
        $middleName = $row['MiddleName'];
        $lastName = $row['LastName'];
        $position = $row['Position'];
        $salary = $row['Salary'];
        $gender = $row['Gender'];
        $birthDate = $row['BirthDate'];
        $image = $row['Image'];
        include("Edit/EditEmployee.php");
    } else { ?>
        <div class="col-lg-6 m-auto py-2">
            <form method="POST" action="Create.php?table=<?php echo $table; ?>" enctype="multipart/form-data">
                <div class="card row  bg-light">
                    <div class="card-header bg-dark">
                        <h1 class="text-white text-center">Create <?php echo $table; ?></h1>
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_GET['error']; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- inputs -->
                    <!-- First Name -->
                    <div class="py-2">
                        <label for="first-name" class="form-label">First name</label>
                        <input required name="first-name" type="text" class="form-control" id="first-name" value="<?php if (isset($_GET['first-name']))
                                                                                                                        echo ($_GET['first-name']); ?>">
                    </div>
                    <!-- Middle Name -->
                    <div class="py-2">
                        <label for="middle-name" class="form-label">Middle name</label>
                        <input required name="middle-name" type="text" class="form-control " id="middle-name" value="<?php if (isset($_GET['middle-name'])) {
                                                                                                                            echo ($_GET['middle-name']);
                                                                                                                        } ?>">
                    </div>
                    <!-- Last Name -->
                    <div class="py-2">
                        <label for="last-name" class="form-label">Last name</label>
                        <input required name="last-name" type="text" class="form-control " id="last-name" value="<?php if (isset($_GET['last-name']))
                                                                                                                        echo ($_GET['last-name']); ?>">
                    </div>
                    <!-- Position -->
                    <div class="py-2">
                        <label for="position" class="form-label">Position </label>
                        <input required name="position" type="text" class="form-control " id="position" value="<?php if (isset($_GET['position']))
                                                                                                                    echo ($_GET['position']); ?>">
                    </div>
                    <!-- Salary -->
                    <div class="py-2">
                        <label for="salary" class="form-label">Salary</label>
                        <input required name="salary" type="number" class="form-control " id="salary" value="<?php if (isset($_GET['salary']))
                                                                                                                    echo ($_GET['salary']); ?>">
                    </div>
                    <!-- Birth Date -->
                    <div class="py-2">
                        <label for="birth-date" class="form-label">Birth Date</label>
                        <input required name="birth-date" type="date" class="form-control " id="birth-date" value="<?php if (isset($_GET['birth-date']))
                                                                                                                        echo ($_GET['birth-date']); ?>">
                    </div>
                    <!-- Gender -->
                    <div class="py-2">
                        <label for="gender" class="form-label">Gender</label>
                        <select required class="form-select" id="gender" name="gender">
                            <option value="0" selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <!-- Image -->
                    <div class="py-2">
                        <label for="image" class="form-label">Image</label>
                        <div class="input-group">
                            <input type="file" name="image" class="form-control" id="image" aria-label="Upload" value="
                        <?php if (isset($_GET['image']))
                            echo ($_GET['image']); ?>">
                        </div>
                    </div>
                    <!-- button -->
                    <div class="py-3 align-items">
                        <button id="submit-btn" name="submit-btn" class="btn btn-primary" type="submit">Save</button>
                    </div>
                    <!-- Id -->
                    <input data-val="true" data-val-number="The field Id must be a number." data-val-required="The Id field is required." id="Employee_Id" name="Id" type="hidden" value="0">
            </form>
        </div>
    <?php } ?>
    <?php include("Components/Footer.php"); ?>
    <?php include("Content/Scripts.php"); ?>
</body>

</html>