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
    <div class="container body-content">
        <h2><?php echo $table . "s"; ?></h2>
        <p>
            <a class="link-primary" name="create" href="<?php echo $table;?>.php?id=0">Create <?php echo $table; ?></a>
        </p>
        <table class="table table-light table-hover table-border" id="table">
            <thead>
                <tr class="table-dark text-center">
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Position</th>
                    <th scope="col">Image</th>
                    <th scope="col">Salary</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM employees";
                $employees = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($employees)) { ?>
                    <tr class="employee-tr text-center">
                        <td> <?php echo $row['Id']; ?></td>
                        <td> <?php echo $row['FirstName']; ?></td>
                        <td> <?php echo $row['MiddleName']; ?></td>
                        <td> <?php echo $row['LastName']; ?></td>
                        <td> <?php echo $row['BirthDate']; ?></td>
                        <td> <?php echo $row['Position']; ?></td>
                        <td> <img src='<?php echo $row['Image']?>' style='height: 60px; width: 70px' alt='<?php echo $row['FirstName']?>' class='img-circle img-size-50 img-bordered-sm' > </td>
                        <td> <?php echo $row['Salary']; ?></td>
                        <td><a name="edit" class="btn btn-secondary" href="Edit.php?id=<?php echo $row['Id']. "&table=" . $table; ?>">Edit</a></td>
                        <td><a name="delete" class="btn btn-danger " href="delete.php?id=<?php echo $row['Id'] . "&table=" . $table; ?>">Delete</a></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
    <?php include("Components/Footer.php"); ?>
    <?php include("Content/Scripts.php"); ?>
</body>

</html>