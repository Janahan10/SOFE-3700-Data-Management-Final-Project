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
            select s.car_ID
            from order_details o, stored_in s
            where o.car_ID=s.car_ID and o.pickup_loc=s.loc_No and s.loc_No=$pickupLocID and (o.pickup_date>='$dropDate' or o.drop_date<='$pickDate'))
            order by year desc;";
        $car_result=mysqli_query($conn, $query);

        // Request for all the data about the locations
        $sql = "SELECT * FROM location";
        $result = $conn->query($sql);

        // Check results
        if(!$car_result && !$result){
            die("Query Failed: " . mysqli_error($conn));
        } 
    } else {
        // Get information of all cars if rental info not specified
        $query="select * from car order by year desc;";
        $car_result=mysqli_query($conn, $query);

        // Request for all the data about the locations
        $sql = "SELECT * FROM location";
        $result = $conn->query($sql);

        // Check results
        if(!$car_result && !$result){
            die("Query Failed: " . mysqli_error($conn));
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
    <script src="test.js"></script>
    <link rel="stylesheet" href="styles.css">

    <title>Listings</title>
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand mx-3" href="welcomePage.php">Home</a>
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="listings.php">Browse our fleet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contacts</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <?php
                        if (isset($_SESSION["user_id"]) && isset($_SESSION["fname"]) && isset($_SESSION["lname"])) {
                            echo "
                                <li class=\"nav-item dropdown\">
                                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbaruserDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                        Welcome, ".$_SESSION["fname"]." ".$_SESSION["lname"]."
                                    </a>
                                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                                        <a class=\"dropdown-item\" href=\"list-orders.php\">Check orders</a>
                                        <div class=\"dropdown-divider\"></div>
                                        <a class=\"dropdown-item\" href=\"logout.php\">Sign out</a>
                                    </div>
                                </li>";
                        } else {
                            echo "
                                <li class=\"nav-item\">
                                    <a class=\"nav-link\" href=\"sign-in.html\">Sign in</a>
                                </li>
                                <li class=\"nav-item\">
                                    <a class=\"nav-link\" href=\"sign-up.html\">Sign up</a>
                                </li>";
                        }
                    ?>
                </ul>
            </div>
        </nav>

    <div class="jumbotron p-1 mb-0 bg-light">
        <form class="cards-container px-5 pt-2 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get" novalidate>
            <div class="form-group row justify-content-around">
                <div class="col-md-6">
                    <label for="inputPickupLoc" class="col-md-10 col-form-label">Pick a Location</label>
                    <select id="inputPickupLoc" class="form-control" name="pickupLocID" required>
                        <option selected value="" disabled>Choose a location</option>
                        <?php
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
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
                <div class="col-md-3">
                    <label for="inputPickupDate" class="col-md-12 col-form-label">Pickup Date</label>
                    <input type="date" class="form-control" id="inputPickupDate" name="pickDate" required>
                    <div class="invalid-feedback">
                        Provide a valid pickup date 
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="inputDropDate" class="col-md-12 col-form-label">Drop-off Date</label>
                    <input type="date" class="form-control" id="inputDropDate" name="dropDate" required>
                    <div class="invalid-feedback">
                        Provide a valid drop-off date 
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary bg-dark text-light border-0">Search</button>
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
            <hr class="my-0"/>

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
                        echo "<div class=\"row justify-content-center py-5\">";
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
                                    <a href=\"vehicle.php?pickupLocID=$pickupLocID&pickDate=$pickDate&dropDate=$dropDate&carID=$carID\" class=\"btn btn-primary center bg-dark text-light border-0\" onclick=\"on()\">Reserve</a>
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
                    
                    // increment the counter
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