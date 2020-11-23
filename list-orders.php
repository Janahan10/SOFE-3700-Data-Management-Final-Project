<?php

    $server="localhost";
    $user="admin";
    $pass="password";
    $dbname="car_rental";

    //Create connection
    $conn=mysqli_connect($server,$user,$pass,$dbname);

    //check connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    // Start a session
    session_start();

    if (isset($_SESSION["user_id"])) {
        // Get the user id
        $user_id=$_SESSION["user_id"];

        // Make query and get results
        $query="select * from order_details where client_ID=$user_id;";
        $result=mysqli_query($conn,$query);

        // Check results
        if(!$result){
            die("Query Failed: " . mysqli_error($conn));
        }else{
            if(mysqli_num_rows($result)>0){
                // Get row of info
                $row=$result->fetch_assoc();
                $order_num=$row["orderNo"];
                $car_ID=$row["car_ID"];
                $pickupLocID=$row["pickup_loc"];
                $dropLocID=$row["drop_loc"];
                $pickDate=$row["pickup_date"];
                $dropDate=$row["drop_date"];
                $totalCost=$row["total_cost"];
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- SCRIPTS -->
        <link rel="stylesheet" href="styles.css">

        <title>Your Orders</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand mx-auto" href="welcomePage.php">Logo</a>
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
            <div class="mx-auto order-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Right</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
            // Get the car information
            if (isset($car_ID)) {
                // Make query and get results
                $car_query="select year, make, model, color from car where ID=$car_ID;";
                $car_result=mysqli_query($conn,$car_query);

                // Check results
                if(!$car_result){
                    die("Query Failed: " . mysqli_error($conn));
                }else{
                    if(mysqli_num_rows($car_result)>0){
                        // Get row of info
                        $car_row=$car_result->fetch_assoc();
                        $carYear=$car_row["year"];
                        $carMake=$car_row["make"];
                        $carModel=$car_row["model"];
                        $carColor=$car_row["color"];
                    }
                }
            }
        ?>

        <div class="jumbotron" style="background-image: url(images/cars/<?php echo "$carMake\ $carModel\ $carColor"?>.jpg); height: 25vw; background-position: center; background-size: cover;"></div>

        <div class="container my-4">
            <div class="row justify-content-left">
                <h1>Order #<?php echo $order_num?></h1>
            </div>
            <form action="returned.php" method="post">  
                <input type="number" class="form-control d-none" name="orderNo" value="<?php echo $order_num?>" readonly>       
                <div class="accordian" id="orderDetails">
                    
                    <div class="card">
                        <div class="card-header" id="carHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#carInfo" aria-expanded="true" aria-controls="carInfo">
                                    Vehicle Information
                                </button>
                            </h2>
                        </div>
                        <div id="carInfo" class="collapse show" aria-labelledby="carHead" data-parent="#orderDetails">
                            <div class="row pt-3 m-3 text-left justify-content-around">
                                <div class="col-10">
                                    <p class="font-weight-bold"><?php echo "$carYear $carMake $carModel: $carColor"?></p>
                                    <input type="number" class="form-control d-none" name="car_ID" value="<?php echo $car_ID?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        // Get pickup loc information
                        if (isset($pickupLocID)) {
                            // retrieve the pickup location
                            $retrievePick="select * from location where Loc_no='$pickupLocID';";
                            $pickLocResult=mysqli_query($conn,$retrievePick);

                            if(mysqli_num_rows($pickLocResult)>0){
                                // Get the full address of the pickup location
                                $pickupLocRow=$pickLocResult->fetch_assoc();
                                $pickupLoc=$pickupLocRow["address_line"]. ", " . $pickupLocRow["city"] . ", " . $pickupLocRow["province"] . " " . $pickupLocRow["ZIP"];
                            }
                        }
                    ?>

                    <div class="card">
                        <div class="card-header" id="pickupLocHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#pickupLocInfo" aria-expanded="true" aria-controls="pickupLocInfo">
                                    Pickup Location
                                </button>
                            </h2>
                        </div>
                        <div id="pickupLocInfo" class="collapse show" aria-labelledby="pickupLocHead" data-parent="#orderDetails">
                            <div class="row pt-3 m-3 text-left justify-content-around">
                                <div class="col-10">
                                    <p class="font-weight-bold"><?php echo $pickupLoc?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        // Get drop-off loc information
                        if (isset($dropLocID)) {
                            // retrieve the drop location
                            $retrieveDrop="select * from location where Loc_no='$dropLocID';";
                            $dropLocResult=mysqli_query($conn,$retrieveDrop);

                            if(mysqli_num_rows($dropLocResult)>0){
                                // Get the full address of the pickup location
                                $dropLocRow=$dropLocResult->fetch_assoc();
                                $dropLoc=$dropLocRow["address_line"]. ", " . $dropLocRow["city"] . ", " . $dropLocRow["province"] . " " . $dropLocRow["ZIP"];
                            }
                        }
                    ?>

                    <div class="card">
                        <div class="card-header" id="dropLocHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#dropLocInfo" aria-expanded="true" aria-controls="dropLocInfo">
                                    Drop-off Location
                                </button>
                            </h2>
                        </div>
                        <div id="dropLocInfo" class="collapse show" aria-labelledby="dropLocHead" data-parent="#orderDetails">
                            <div class="row pt-3 m-1 text-left justify-content-around">
                                <div class="col-10">
                                    <p class="font-weight-bold"><?php echo $dropLoc?></p>
                                    <input type="number" class="form-control d-none" name="dropLocID" value="<?php echo $dropLocID?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="pickDropDateHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#pickDropDateInfo" aria-expanded="true" aria-controls="pickDropDateInfo">
                                    Pickup/Drop-off Date
                                </button>
                            </h2>
                        </div>
                        <div id="pickDropDateInfo" class="collapse show" aria-labelledby="pickDropDateHead" data-parent="#orderDetails">
                            <div class="row p-2 m-1 text-left justify-content-around">
                                <div class="col-5">                                   
                                    <p class="font-weight-bold mb-0 mt-2">Pickup Date:</p>
                                    <p class="font-weight-bold"><?php echo $pickDate?></p>    
                                </div>
                                <div class="col-5">
                                    <p class="font-weight-bold mb-0 mt-2">Drop-off Date:</p>
                                    <p class="font-weight-bold"><?php echo $dropDate?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="costHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#costInfo" aria-expanded="true" aria-controls="costInfo">
                                    Total Cost
                                </button>
                            </h2>
                        </div>
                        <div id="costInfo" class="collapse show" aria-labelledby="costHead" data-parent="#orderDetails">
                            <div class="row pt-3 m-3 text-left justify-content-around">
                                <div class="col-10">
                                    <p class="font-weight-bold">CA $<?php echo $totalCost?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                
                    
                </div>
                <div class="form-group row mt-5 justify-content-around">
                    <div class="col-3">
                        <button type="submit" class="btn btn-lg btn-primary">Return</button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="logout.php"><p>Sign out</p></a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>