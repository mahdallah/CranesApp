<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "hijaz";

$con = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
// include("../MySql/Includes/dbh.inc.php");
$serviceThisYear = 2;
$customers = 2;
$cranes = 4;
?>
<div class="" style="min-height: 648px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php
                            $reslutServices = $con -> query("SELECT COUNT(employees.Id) FROM employees;");
                            $rowServices = mysqli_fetch_array($reslutServices);
                            $service = $rowServices[0];                            
                            echo $service;?></h3>
                            <p>Employees</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php 
                            $resultThisYear = $con -> query("SELECT COUNT(quotes.Id) FROM quotes;");
                            $rowThisYear = mysqli_fetch_array($resultThisYear);
                            
                            $serviceThisYear = $rowThisYear[0];   


                            echo $serviceThisYear;?><sup style="font-size: 20px">%</sup></h3>
                            
                            <p>Service This Year</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php 
                            $resultCustomers = $con -> query("SELECT COUNT(Customers.Id) FROM customers;");
                            $rowCusotmers = mysqli_fetch_array($resultCustomers);
                            $customers = $rowCusotmers[0]; 
                            echo $customers;?></h3>

                            <p>Customers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php 
                            $resultCranes = $con -> query("SELECT COUNT(Cranes.Id) FROM cranes;");
                            $rowCranes = mysqli_fetch_array($resultCranes);
                            $cranes = $rowCranes[0]; 
                            echo $cranes;?></h3>

                            <p>Cranes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>
</div>