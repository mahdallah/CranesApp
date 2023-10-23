<?php
$applicationName = "Hijaz Crane Service";
$table = "Customer";
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
        $query = "SELECT * FROM customers where Id = '$id'";
        $result = mysqli_query($con, $query);
        $row  = mysqli_fetch_assoc($result);
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        include("Edit/EditCustomer.php");
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
                                                                                                                        echo ($_GET['first-name']);
                                                                                                                    ?>">
                    </div>
                    <!-- Last Name -->
                    <div class="py-2">
                        <label for="last-name" class="form-label">Last name</label>
                        <input required name="last-name" type="text" class="form-control " id="last-name" value="<?php if (isset($_GET['last-name']))
                                                                                                                        echo ($_GET['last-name']); ?>">
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