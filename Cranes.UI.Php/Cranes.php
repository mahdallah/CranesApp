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
    <div class="container body-content">
        <div class="container ">
            <h2><?php echo $table . "s"; ?></h2>
            <p>
                <a class="link-primary" name="create" href="<?php echo $table; ?>.php?id=0">Create <?php echo $table; ?></a>
            </p>
            <div class="row row-cols-1 row-cols-lg-4 g-4">
                <?php
                $query = "SELECT * FROM cranes";
                $employees = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($employees)) { ?>
                    <div class="col">
                        <div class="card" style="" name="<?php echo $row['Id']; ?>">
                            <img class="card-img-top rounded" src="<?php echo $row['Image']; ?>" alt="<?php echo $row['Name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $row['Name']; ?> </h5>
                                <span class="card-text">Lifts <?php echo $row['MaxWeightLiftInTon']; ?> Ton</span>
                                <p class="card-text"><?php echo $row['PricePerHour'] * 4; ?> $ per Four hours <?php echo $row['PricePerItem']; ?> $ per Item</p>
                                <input class="btn btn-primary" type="submit" value="Hire" />
                                <div class="my-2">
                                <td><a name="edit" class="btn btn-secondary" href="Edit.php?id=<?php echo $row['Id']. "&table=" . $table; ?>">Edit</a></td>
                                    <a name="delete" class="btn btn-danger " href="delete.php?id=<?php echo $row['Id'] . "&table=" . $table; ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <tbody>
            </tbody>
            </table>
        </div>
    </div>
    <?php include("Components/Footer.php"); ?>
    <?php include("Content/Scripts.php"); ?>
</body>

</html>