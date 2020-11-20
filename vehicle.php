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

    // Get variables passed through get method
    $pickupLocID=$_GET["pickupLoc"];
    $pickDate=date_create($_GET["pickDate"]);
    $dropDate=date_create($_GET["dropDate"]);
    $carID=$_GET["carID"];

    if ($pickupLocID && $pickDate && $dropDate && $carID) {
        // Retrieve the car information
        $retrieveCar="select * from car where ID='$carID';";
        $carResult=mysqli_query($conn,$retrieveCar);

        // retrieve all locations
        $retrieveLoc="select * from location;";
        $locResult=mysqli_query($conn,$retrieveLoc);

        // retrieve the pickup location
        $retrievePick="select * from location where Loc_no='$pickupLocID';";
        $pickLocResult=mysqli_query($conn,$retrievePick);

        // Check results
        if(!$carResult && !$locResult && !$pickLocResult){
            die("Query Failed: " . mysqli_error($conn));
        }else{
            if(mysqli_num_rows($carResult)>0 && mysqli_num_rows($pickLocResult)>0){
                // get all of the car information
                $car=$carResult->fetch_assoc();
                $carYear=$car["year"];
                $carMake=$car["make"];
                $carModel=$car["model"];
                $carColor=$car["color"];
                $carClass=$car["class"];
                $carBody=$car["body"];
                $carSeats=$car["seats"];
                $carMSRP=$car["MSRP"];
                $carEngine=$car["engine"];
                $carTransmission=$car["transmission"];
                $carDayCost=$car["cost_per_day"];

                // Get the difference between the pick and drop dates
                $interval=date_diff($pickDate, $dropDate);
                $diff=intval($interval->format("%d"));
                // Calculate the total cost of the rental
                $totalCost=$carDayCost*$diff*1.13;

                // Get the full address of the pickup location
                $pickupLocRow=$pickLocResult->fetch_assoc();
                $pickupLoc=$pickupLocRow["address_line"]. ", " . $pickupLocRow["city"] . ", " . $pickupLocRow["province"] . " " . $pickupLocRow["ZIP"];
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
        <script src="script.js"></script>

        <title></title>

        <style>
            p{
                font-size: 1.1em;
            }
        </style>
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

        <div class="jumbotron" style="background-image: url(images/cars/<?php echo "$carMake\ $carModel\ $carColor"?>.jpg); height: 25vw; background-position: center; background-size: cover;">

        </div>
        <div class="container my-4">
            <div class="row justify-content-center">
                <h1><?php echo "$carYear $carMake $carModel"?></h1>
            </div>
            <div class="accordian" id="pageInfo">
                <div class="card">
                    <div class="card-header" id="vehicleInfoHead">
                        <h2>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#vehicleInfo" aria-expanded="true" aria-controls="vehicleInfo">
                                Vehicle Information
                            </button>
                        </h2>
                    </div>
                    <div id="vehicleInfo" class="collapse show" aria-labelledby="vehicleInfoHead" data-parent="#pageInfo">
                        <div class="row p-3 m-3 text-center justify-content-around">
                            <div class="col-3">
                                <p class="font-weight-bold mb-0">Class</p>
                                <p><?php echo "$carClass"?></p>
                                <p class="font-weight-bold mb-0">Engine</p>
                                <p><?php echo "$carEngine"?></p>
                            </div>
                            <div class="col-3">
                                <p class="font-weight-bold mb-0">Color</p>
                                <p><?php echo "$carColor"?></p>
                                <p class="font-weight-bold mb-0">Transmission</p>
                                <p><?php echo "$carTransmission"?></p>                                       
                            </div>
                            <div class="col-3">
                                <p class="font-weight-bold mb-0">Body</p>
                                <p><?php echo "$carBody"?></p>
                                <p class="font-weight-bold mb-0">MSRP</p>
                                <p><?php echo "$carMSRP"?></p>
                            </div>
                            <div class="col-3">
                                <p class="font-weight-bold mb-0">Seats</p>
                                <p><?php echo "$carSeats"?></p>
                                <p class="font-weight-bold mb-0">$/day</p>
                                <p><?php echo "$carDayCost"?></p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <form action="add-order.php" method="post">
                    <div class="card">
                        <div class="card-header" id="rentalInfoHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#rentalInfo" aria-expanded="true" aria-controls="rentalInfo">
                                    Rental Information
                                </button>
                            </h2>
                        </div>
                        <div id="rentalInfo" class="collapse show" aria-labelledby="rentalInfoHead" data-parent="#pageInfo">
                            <input type="number" class="form-control d-none" id="carID" name="carID" value="<?php echo "$carID"?>" readonly>
                            <div class="row p-2 m-1 text-left justify-content-center">
                                <div class="col-10">
                                    <label for="pickupAddress">Pickup Location</label>
                                    <input type="text" class="form-control" id="pickupAddress" value="<?php echo "$pickupLoc"?>" readonly required>
                                    <input type="number" class="form-control d-none" id="pickupLocID" name="pickupLocID" value="<?php echo "$pickupLocID"?>" readonly>
                                </div>
                            </div>
                            <div class="row p-2 m-1 text-left justify-content-center">
                                <div class="col-10">
                                    <label for="dropLocID">Drop-off Location</label>
                                    <select id="dropLocID" class="form-control" name="dropLocID" required>
                                        <option selected value="" disabled>Choose a location</option>
                                        <?php
                                            if ($locResult->num_rows > 0) {
                                                // output data of each row
                                                while($row = $locResult->fetch_assoc()) {
                                                    echo "<option value=" . $row["Loc_no"]. ">" . $row["address_line"]. ", "
                                                        . $row["city"] . ", " . $row["province"] . " " . $row["ZIP"] . "</option>";
                                                }
                                            }

                                            // Close the connection
                                            $conn->close();
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose a location.
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 m-1 text-left justify-content-center">
                                <div class="col-5">                                   
                                    <label for="inputPickupDate" class="col-md-12 col-form-label">Pickup Date</label>
                                    <input type="date" class="form-control" id="inputPickupDate" name="pickDate" value="<?php echo $_GET["pickDate"]?>" readonly>
                                </div>
                                <div class="col-5">
                                    <label for="inputDropDate" class="col-md-12 col-form-label">Drop-off Date</label>
                                    <input type="date" class="form-control" id="inputDropDate" name="dropDate" value="<?php echo $_GET["dropDate"]?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php 
                    if(!isset($_SESSION["fname"]) && !isset($_SESSION["lname"]) && !isset($_SESSION["user"]) && !isset($_SESSION["user_id"])){
                        echo "<div class=\"card\">
                            <div class=\"card-header\" id=\"loginSignupHead\">
                                <h2>
                                    <button class=\"btn btn-link\" type=\"button\" data-toggle=\"collapse\" data-target=\"#loginSignup\" aria-expanded=\"false\" aria-controls=\"loginSignup\">
                                        Login/Sign up
                                    </button>
                                </h2>
                            </div>
                            <div id=\"loginSignup\" class=\"collapse show p-2\" aria-labelledby=\"loginSignupHead\" data-parent=\"#pageInfo\">
                                <div id=\"login\">
                                    <div class=\"form-group row justify-content-center\">
                                        <div class=\"col-11\">
                                            <label for=\"username\" class=\"col-form-label\">Username</label>
                                            <input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" placeholder=\"Username\" required>
                                            <div class=\"invalid-feedback\">
                                                Please provide a valid username.
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"form-group row justify-content-center\">
                                        <div class=\"col-11\">
                                            <label for=\"password\" class=\"col-form-label\">Password</label>
                                            <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" placeholder=\"Password\" required>
                                            <div class=\"invalid-feedback\">
                                                Please provide a valid passowrd.
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"form-group row justify-content-center\">
                                        <div class=\"col-10 text-right\">
                                            <a href=\"sign-up.html\">Create an account</a>
                                        </div>
                                </div>  
                            </div>
                        </div>";
                    }
                    
                ?>

                    <div class="card">
                        <div class="card-header" id="paymentInfoHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#paymentInfo" aria-expanded="false" aria-controls="paymentInfo">
                                    Payment Information
                                </button>
                            </h2>
                        </div>
                        <div id="paymentInfo" class="collapse show" aria-labelledby="paymentInfoHead" data-parent="#pageInfo">
                            <div class="form-group row justify-content-left mt-2">
                                <div class="col-1"></div>
                                <div class="col-1">
                                    <label for="totalCost" class="col-form-label font-weight-bold">Total: $</label>
                                </div>
                                <div class="col-2">
                                    <input type="number" class="form-control" id="totalCost" name="totalCost" value="<?php echo "$totalCost"?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-5">
                                    <label for="name" class="col-form-label">Full name on card</label>
                                    <input type="text" class="form-control" id="name" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Please provide a name.
                                    </div>
                                </div>
                                <div class="col-5">
                                    <label for="cardNo" class="col-form-label">Debit/Credit Card Number</label>
                                    <input type="number" class="form-control" id="cardNo" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Please provide a card number.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-4">
                                    <label for="expDate">Expiry Date</label>
                                    <input type="month" class="form-control" id="expDate" required>
                                    <div class="invalid-feedback">
                                        Please choose a month.
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="CVV">Security Code</label>
                                    <input type="number" class="form-control" id="CVV" max="999" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid number.
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="billZIP">Billing Postal Code</label>
                                    <input type="text" class="form-control" id="billZIP" required>
                                    <div class="invalid-feedback">
                                        Please enter a ZIP code.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-10">
                                    <button type="submit" class="btn btn-primary">Reserve Now</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <script>
                        (function () {
                            'use strict';
                            window.addEventListener('load', function () {
    
                                var forms = document.getElementsByClassName('needs-validation');
    
                                var validation = Array.prototype.filter.call(forms, function (form) {
                                    form.addEventListener('submit', function (event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            }, false);
                        })();
                    </script>
                </form>
            </div>
        </div>
    </body>
</html>