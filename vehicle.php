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
    $pickupLoc=$_GET["pickupLoc"];
    $pickDate=$_GET["pickDate"];
    $dropDate=$_GET["dropDate"];
    $carID=$_GET["carID"];

    if ($pickupLoc && $pickDate && $dropDate && $dropDate) {
        // Retrieve the car information
        $retrieveCar="select * from car where ID='$carID';";
        $carResult=mysqli_query($conn,$query);

        // Check results
        if(!$carResult){
            die("Query Failed: " . mysqli_error($conn));
        }else{
            if(mysqli_num_rows($result)>0){
                // get the row of information
                $car=$carResult->fetch_assoc();
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

        <div class="jumbotron" style="background-image: url(images/cars/Lamborghini\ Aventador.jpg); height: 25vw; background-position: center; background-size: cover;">

        </div>
        <div class="container my-4">
            <div class="row justify-content-center">
                <h1>'Year' 'Make' 'Model'</h1>
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
                                <p>'Class'</p>
                                <p class="font-weight-bold mb-0">Engine</p>
                                <p>'Engine'</p>
                            </div>
                            <div class="col-3">
                                <p class="font-weight-bold mb-0">Color</p>
                                <p>'Color'</p>
                                <p class="font-weight-bold mb-0">Transmission</p>
                                <p>'Transmission'</p>                                       
                            </div>
                            <div class="col-3">
                                <p class="font-weight-bold mb-0">Body</p>
                                <p>'Body'</p>
                                <p class="font-weight-bold mb-0">MSRP</p>
                                <p>'MSRP'</p>
                            </div>
                            <div class="col-3">
                                <p class="font-weight-bold mb-0">Seats</p>
                                <p>'Seats'</p>
                                <p class="font-weight-bold mb-0">$/day</p>
                                <p>'Cost/day'</p>
                                <input type="number" class="form-control d-none" id="dayCost" value="10" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="#" method="post">
                    <div class="card">
                        <div class="card-header" id="rentalInfoHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#rentalInfo" aria-expanded="true" aria-controls="rentalInfo">
                                    Rental Information
                                </button>
                            </h2>
                        </div>
                        <div id="rentalInfo" class="collapse show" aria-labelledby="rentalInfoHead" data-parent="#pageInfo">
                            <input type="number" class="form-control d-none" id="carID" name="carID" value="1" readonly>
                            <div class="row p-2 m-1 text-left justify-content-center">
                                <div class="col-10">
                                    <label for="pickupAddress">Pickup Location</label>
                                    <input type="text" class="form-control" id="pickupAddress" value="Address" readonly required>
                                    <input type="number" class="form-control d-none" id="pickupLocID" name="pickupLocID" value="" readonly>
                                </div>
                            </div>
                            <div class="row p-2 m-1 text-left justify-content-center">
                                <div class="col-10">
                                    <label for="dropLocID">Drop-off Location</label>
                                    <select id="dropLocID" class="form-control" name="dropLocID" required>
                                        <option selected value="" disabled>Choose a location</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose a location.
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 m-1 text-left justify-content-center">
                                <div class="col-5">                                   
                                    <label for="inputPickupDate" class="col-md-12 col-form-label">Pickup Date</label>
                                    <input type="date" class="form-control" id="inputPickupDate" name="pickDate" value="" readonly>
                                </div>
                                <div class="col-5">
                                    <label for="inputDropDate" class="col-md-12 col-form-label">Drop-off Date</label>
                                    <input type="date" class="form-control" id="inputDropDate" name="dropDate" value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                
                    <div class="card">
                        <div class="card-header" id="loginSignupHead">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#loginSignup" aria-expanded="false" aria-controls="loginSignup">
                                    Login/Sign up
                                </button>
                            </h2>
                        </div>
                        <div id="loginSignup" class="collapse show p-2" aria-labelledby="loginSignupHead" data-parent="#pageInfo">
                            <div id="login">
                                <div class="form-group row justify-content-center">
                                    <div class="col-11">
                                        <label for="username" class="col-form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid username.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-11">
                                        <label for="password" class="col-form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid passowrd.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="signup" style="display: none;">
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-5">
                                        <label for="fname" class="col-form-label">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                                        <div class="invalid-feedback">
                                            Please provide first name.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="lname" class="col-form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                                        <div class="invalid-feedback">
                                            Please provide last name.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="form-group col-md-3">
                                        <label for="phone" class="col-form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid phone number.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="dNo" class="col-form-label">Drivers License No.</label>
                                        <input type="text" class="form-control" id="dNo" name="dNo" placeholder="Drivers License" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid drivers license number.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="dob" class="col-form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid date of birth.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row justify-content-center">
                                    <div class="form-group col-md-5">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid email.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid username.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="form-group col-md-5">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid passowrd.
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="repeatPassword">Repeat Password</label>
                                        <input type="password" class="form-control" id="repeatPassword" placeholder="Repeat Password" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid password.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check">
                                <div class="col-11">
                                    <input type="checkbox" class="form-check-input" id="hasAccount" name="has_account" value="true" onclick="switchForm()">
                                    <label class="form-check-label" for="exampleCheck1">I don't have an account</label>
                                </div>
                            </div>     
                        </div>
                    </div>

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
                                    <input type="number" class="form-control" id="totalCost" value="10" readonly>
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