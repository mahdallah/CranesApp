<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/php_projects/Hijaz/Home.php"><?php echo $applicationName; ?></a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($table == "Home") echo "active" ?>" aria-current="page" href="/php_projects/Hijaz/Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($table == "Employee") echo "active" ?>" href="/php_projects/Hijaz/Employees.php">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($table == "Crane") echo "active" ?>" href="/php_projects/Hijaz/Cranes.php">Cranes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($table == "Customer") echo "active" ?>" href="/php_projects/Hijaz/Customers.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($table == "Quote") echo "active" ?>" href="/php_projects/Hijaz/Quotes.php">Quotes</a>
                    </li>
                </ul>
                <!-- Search  -->
                <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
</header>