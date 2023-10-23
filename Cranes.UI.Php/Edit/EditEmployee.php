<div class="col-lg-6 m-auto py-2">
    <form method="POST" action="Edit.php?id=<?php echo $_GET['id']; ?>&table=<?php echo $table; ?>" enctype="multipart/form-data">
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
                <input required name="first-name" type="text" class="form-control" id="first-name" value=<?php echo $firstName ?>>
            </div>
            <!-- Middle Name -->
            <div class="py-2">
                <label for="middle-name" class="form-label">Middle name</label>
                <input required name="middle-name" type="text" class="form-control " id="middle-name" value=<?php echo $middleName ?>>
            </div>
            <!-- Last Name -->
            <div class="py-2">
                <label for="last-name" class="form-label">Last name</label>
                <input required name="last-name" type="text" class="form-control " id="last-name" value=<?php echo $lastName ?>>
            </div>
            <!-- Position -->
            <div class="py-2">
                <label for="position" class="form-label">Position </label>
                <input required name="position" type="text" class="form-control " id="position" value=<?php echo $position ?>>
            </div>
            <!-- Salary -->
            <div class="py-2">
                <label for="salary" class="form-label">Salary</label>
                <input required name="salary" type="number" class="form-control " id="salary" value=<?php echo $salary ?>>
            </div>
            <!-- Birth Date -->
            <div class="py-2">
                <label for="birth-date" class="form-label">Birth Date</label>
                <input required name="birth-date" type="date" class="form-control " id="birth-date" value=<?php echo $birthDate ?>>
            </div>
            <!-- Gender -->
            <div class="py-2">
                <label for="gender" class="form-label">Gender</label>
                <select required class="form-select" id="gender" name="gender">
                    <?php if ($gender === "Male") { ?>
                        <option selected value="Male">Male</option>
                        <option value="Female">Female</option>
                    <?php } else { ?>
                        <option value="Male">Male</option>
                        <option selected value="Female">Female</option>
                    <?php } ?>
                </select>
            </div>
            <!-- Image -->
            <div class="py-2">
                <label for="image" class="form-label">Image</label>
                <div class="input-group">
                    <input type="file" name="image" class="form-control" id="image" aria-label="Upload" value=<?php echo $image ?>>
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