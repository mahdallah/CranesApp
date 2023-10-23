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
                <!-- Customers  -->
                <div class="py-2">
                    <label for="customer-id" class="form-label">Customer</label>
                    <select required class="form-select" id="customer-id" name="customer-id">
                        <option selected value="0">Select Customer</option>
                        <?php
                        $query = "SELECT * FROM customers";
                        $classes = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($classes)) { ?>
                            <option value="<?php echo $row['Id'] ?>"> <?php echo $row['FirstName'] . " " . $row['LastName']; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Cranes  -->
                <div class="py-2">
                    <label for="crane-id" class="form-label">Cranes</label>
                    <select required class="form-select" id="crane-id" name="crane-id">
                        <!-- <option selected value="0">Select Crane</option> -->
                        <?php
                        $query = "SELECT * FROM cranes";
                        $classes = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_array($classes)) { ?>
                            <option price-per-item="<?php echo $row['PricePerItem']; ?>" price-per-hour="<?php echo $row['PricePerHour']; ?>" value="<?php echo $row['Id'] ?>"> <?php echo $row['Name'] . " " . $row['MaxWeightLiftInTon'] . " Ton " . $row['PricePerHour'] . "$ per hour " . $row['PricePerItem'] . "$ per item"; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Radio Buttons -->
                <div class="py-2">
                    <div class="form-check" id="div-for-Hours">
                        <input class="form-check-input" type="radio" checked name="is-for-hours-items" value="hours" id="is-for-hours">
                        <label class="form-check-label" for="is-for-hours">
                            In Hours
                        </label>
                    </div>
                    <div class="form-check" id="div-for-items">
                        <input class="form-check-input" type="radio" name="is-for-hours-items" value="items" id="is-for-items">
                        <label class="form-check-label" for="is-for-items">
                            Items
                        </label>
                    </div>
                </div>
                <!-- Hired Hours -->
                <div class="py-2" id="div-hired-hours">
                    <label for="hired-hours" class="form-label">Hired Hours</label>
                    <input name="hired-hours" type="number" class="input-hours form-control" id="hired-hours" value="0<?php if (isset($_GET['hired-hours']))
                                                                                                                            echo ($_GET['hired-hours']); ?>">
                </div>
                <!-- Hired Items -->
                <div class="py-2" id="div-hired-items">
                    <label for="hired-items" class="form-label">Hired Items</label>
                    <input name="hired-items" type="number" class="input-items form-control" id="hired-items" value="0<?php if (isset($_GET['hired-items']))
                                                                                                                            echo ($_GET['hired-items']); ?>">
                </div>
                <!-- Dicount -->
                <div class="py-2">
                    <label for="discount" class="form-label">Discount Rate %</label>
                    <input name="discount" type="number" class="form-control" id="discount" value="0<?php
                                                                                                    if (isset($_GET['discount']))
                                                                                                        echo ($_GET['discount']); ?>">
                </div>
                <!-- Total -->
                <div class="py-2">
                    <label for="total" class="form-label">Total</label>
                    <input name="total" type="number" class="form-control" id="total" value="0" readonly>
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
    <script>
        $(document).ready(function() {
            // Vars
            var divForInputHours = $('#div-hired-hours');
            var divForInputItems = $('#div-hired-items');
            // Initial 
            divForInputItems.hide();
            // Radio Button Change
            $('input[type=radio][name=is-for-hours-items]').change(function() {
                if (this.value == 'hours') {
                    divForInputItems.hide();
                    divForInputHours.show();
                    $('#hired-items').val(0);
                } else if (this.value == 'items') {
                    divForInputHours.hide();
                    divForInputItems.show();
                    $('#hired-hours').val(0);
                }
                // $('#total').val(0);
            });
            $('#hired-hours').on('focusout', function(){
                calculation();
            })
            $('#hired-items').on('focusout', function(){
                calculation();
            })
            $('#discount').on('focusout', function(){
                calculation();
            })
            // Functions
            function calculation(){
                var radio = $('input[name=is-for-hours-items]').val();
                if(radio == 'hours'){
                    var hours = $('#hired-hours')
                    var perHour = $('#crane-id').find('option:selected').attr('price-per-hour');
                    var dicountRate = $('#discount').val();
                    if(Number.isNaN(hours)){
                        items = 0;
                    }
                    else if(Number.isNaN(dicountRate)){
                        dicountRate = 0;
                    }
                    var price = perItem * hours
                    var total = price - (price * dicountRate);
                    $('#total').val(total);
                    console.log("hours")
                }
                else{
                    var items = $('#hired-items')
                    var perItem = $('#crane-id').find('option:selected').attr('price-per-item');
                    var dicountRate = $('#discount').val();
                    if(Number.isNaN(items)){
                        items = 0;
                    }
                    else if(Number.isNaN(dicountRate)){
                        dicountRate = 0;
                    }
                    var price = perItem * items
                    var total = price - (price * dicountRate);
                    $('#total').val(total);
                    console.log("items")
                }
            }
            calculation();
        })
    </script>
</body>

</html>