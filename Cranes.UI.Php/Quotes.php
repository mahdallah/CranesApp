<?php
$applicationName = "Hijaz Crane Service";
$table = "Quote";
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
            <a class="link-primary" name="create" href="<?php echo $table; ?>.php?id=0"><?php echo "Make Quotation" ?></a>
        </p>

        <table class="table table-light table-hover table-border" id="table">
            <thead>
                <tr class="table-dark text-center">
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Crane Name</th>
                    <th scope="col">Crane Plate</th>
                    <th scope="col">Hired For</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Total</th>
                    <th scope="col">Registered Date</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT quotes.Id, customers.FirstName, customers.LastName, cranes.Name, cranes.Plate, quotes.HiredHours, quotes.HiredItems, quotes.Date, quotes.Discount, quotes.Total 
                FROM quotes INNER JOIN customers ON quotes.Customer_Id = customers.Id INNER JOIN cranes ON quotes.Crane_Id = cranes.Id;";
                $employees = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($employees)) { ?>
                    <tr class="employee-tr text-center">
                        <td> <?php echo $row['Id']; ?></td>
                        <td> <?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
                        <td> <?php echo $row['Name']; ?></td>
                        <td> <?php echo $row['Plate']; ?></td>
                        <td> <?php if ($row['HiredHours'] != 0) {
                                    echo $row['HiredHours'] . " Hour(s)";
                                }
                                if ($row['HiredItems'] != 0) {
                                    echo $row['HiredItems'] . " Item(s)";
                                } ?>
                        </td>
                        <td> <?php echo $row['Discount']; ?>%</td>
                        <td> <?php echo $row['Total']; ?>$</td>
                        <td> <?php echo $row['Date']; ?></td>
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