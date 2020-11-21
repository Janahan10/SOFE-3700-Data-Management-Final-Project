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

    // Get the variables from the welcome page
    $pickupLocID="";
    $pickDate="";
    $dropDate="";
    if (isset($_GET["pickupLocID"]) && isset($_GET["pickDate"]) && isset($_GET["dropDate"])) {
        $pickupLocID=$_GET["pickupLocID"];
        $pickDate=$_GET["pickDate"];
        $dropDate=$_GET["dropDate"];
    }
    

    // Check if the pickup loc, pick and drop date are set
    if ($pickupLocID && $pickDate && $dropDate) {
        // Make query and get cars that arent ordered during that time and are stored in that loc
        $query="select * from car where ID in (
            select o.car_ID
            from order_details o, stored_in s
            where o.car_ID=s.car_ID and o.pickup_loc=s.loc_No and s.loc_No=$pickupLocID and (o.pickup_date>='$dropDate' or o.drop_date<='$pickDate'));";
        // $query="select * from car;";
        $car_result=mysqli_query($conn, $query);

        // Check results
        if(!$car_result){
            die("Query Failed: " . mysqli_error($conn));
        } 
        // else {
        //     // get the car information
        //     $car=$car_result->fetch_assoc();
        //     $carYear=$car["year"];
        //     $carMake=$car["make"];
        //     $carModel=$car["model"];
        //     $carColor=$car["color"];
        //     $carDayCost=$car["cost_per_day"];
        // }
    } else {
        // Get information of all cars if rental info not specified
        $query="select * from car;";
        $car_result=mysqli_query($conn, $query);

        // Check results
        if(!$car_result){
            die("Query Failed: " . mysqli_error($conn));
        }
        // else {
        //     // get the car information
        //     $car=$car_result->fetch_assoc();
            // $carYear=$car["year"];
            // $carMake=$car["make"];
            // $carModel=$car["model"];
            // $carColor=$car["color"];
            // $carDayCost=$car["cost_per_day"];
        // }
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
    <script src="test.js"></script>
    <link rel="stylesheet" href="styles.css">

    <title>Listings</title>
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

    <div class="cards-container">
        <?php 
            if(mysqli_num_rows($car_result)>0){
                // Set hte counter to count 3 cars
                $car_count=0;

                // output data of each car
                while($car = $car_result->fetch_assoc()){

                    // Get the car information to be injected
                    $carYear=$car["year"];
                    $carMake=$car["make"];
                    $carModel=$car["model"];
                    $carColor=$car["color"];
                    $carDayCost=$car["cost_per_day"];
                    $carID=$car["ID"];

                    if ($car_count == 0) {
                        echo "<div class=\"row justify-content-center my-5\">";
                    }

                    echo "
                        <div class=\"col-md-3 mx-5\">
                            <div class=\"card\">
                                <img class=\"card-img-top\" src=\"images/cars/$carMake $carModel $carColor.jpg\" alt=\"Card image cap\">
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">$carYear $carMake $carModel</h5>
                                    <p class=\"card-text\">CA \$$carDayCost/day</p>
                                    ";

                    if ($pickupLocID && $pickDate && $dropDate) {
                        echo "
                                    <a href=\"vehicle.php?pickupLocID=$pickupLocID&pickDate=$pickDate&dropDate=$dropDate&carID=$carID\" class=\"btn btn-primary center\" onclick=\"on()\">Rent</a>
                                </div>
                            </div>
                        </div>";
                    } else {
                        echo "
                                    <p class=\"card-text font-weight-bold\">Please choose a pickup location, pickup and drop-off date</p>
                                </div>
                            </div>
                        </div>";
                    }
                    
                    // incerment the counter
                    $car_count++;

                    if ($car_count >= 3) {
                        echo"</div>";
                        $car_count=0;
                    }

                }
            }
        ?>

    </div>

</body>

</html>