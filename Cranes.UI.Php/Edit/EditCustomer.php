<div class="col-lg-6 m-auto py-2">
    <form method="POST" action="Edit.php?id=<?php echo $_GET['id']; ?>&table=<?php echo $table; ?>" enctype="multipart/form-data">
        <div class="card row  bg-light">
            <div class="card-header bg-dark">
                <h1 class="text-white text-center">Update <?php echo $table; ?></h1>
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
                <input required name="first-name" type="text" class="form-control" id="first-name" value=<?php echo $firstName ?>>
            </div>
            <!-- Last Name -->
            <div class="py-2">
                <label for="last-name" class="form-label">Last name</label>
                <input required name="last-name" type="text" class="form-control " id="last-name" value=<?php echo $lastName ?>>
            </div>
            <!-- button -->
            <div class="py-3 align-items">
                <button id="submit-btn" name="submit-btn" class="btn btn-primary" type="submit">Update</button>
            </div>
            <!-- Id -->
            <input data-val="true" data-val-number="The field Id must be a number." data-val-required="The Id field is required." id="Employee_Id" name="Id" type="hidden" value="0">
    </form>
</div>