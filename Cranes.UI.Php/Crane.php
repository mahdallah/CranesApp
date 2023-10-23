<?php
$applicationName = "Hijaz Crane Service";
$table = "Crane";
include "./MySql/Includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("Content/Head.php"); ?>
</head>

<body>
    <?php include("Components/Header.php"); ?>
    <div class="col-lg-6 m-auto py-2">
        <form method="POST" action="Create.php?table=<?php echo $table;?>" enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Name</label>
                    <input required name="name" type="text" class="form-control" id="name" value="<?php if (isset($_GET['name']))
                                                                                                            echo ($_GET['name']); ?>">
                </div>
                <!-- Maximum Wieght In Ton -->
                <div class="py-2">
                    <label for="max-weight-lift-in-ton" class="form-label">Maximum Wieght In (Ton) </label>
                    <input  name="max-weight-lift-in-ton" type="number" class="form-control " id="max-weight-lift-in-ton" value="<?php if (isset($_GET['max-weight-lift-in-ton'])){echo ($_GET['max-weight-lift-in-ton']);}?>">
                </div>
                <!-- Price Per Hours -->
                <div class="py-2">
                    <label for="price-per-hour" class="form-label">Price Per Hours</label>
                    <input name="price-per-hour" type="number" class="form-control " id="price-per-hour" value="<?php if (isset($_GET['price-per-hour']))
                                                                                                        echo ($_GET['price-per-hour']); ?>">
                </div>
                <!-- Price Per Item -->
                <div class="py-2">
                    <label for="price-per-item" class="form-label">Price Per Item</label>
                    <input name="price-per-item" type="number" class="form-control " id="price-per-item" value="<?php if (isset($_GET['price-per-item']))
                                                                                                            echo ($_GET['price-per-item']); ?>">
                </div>
                <!-- Plate -->
                <div class="py-2">
                    <label for="plate" class="form-label">Plate</label>
                    <input name="plate" type="text" class="form-control " id="plate" value="<?php if (isset($_GET['plate']))
                                                                                                            echo ($_GET['plate']); ?>">
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
    <?php include("Components/Footer.php"); ?>
    <?php include("Content/Scripts.php"); ?>
</body>

</html>