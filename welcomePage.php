<?php
    $servername = "localhost";
    $username = "admin";
    $password = "password";
    $dbname = "car_rental";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start a session
    session_start();

    // Request for all the data about the locations
    $sql = "SELECT * FROM location";
    $result = $conn->query($sql);
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

        <title>Welcome to ###</title>
    </head>

    <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand mx-3" href="welcomePage.php">Home</a>
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="listings.php">Browse our fleet</a>
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
    <div class="jumbotron">
        <div class="text-center mx-3 my-3">
            <h1>Book Your Rental Today</h1>
        </div>
        <form class="container px-3 py-3 needs-validation" action="listings.php" method="get" novalidate>
            <div class="form-group row">
                <div class="col-md-12">
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
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="date" class="form-control" id="inputPickupDate" name="pickDate" required>
                    <label for="inputPickupDate" class="col-md-12 col-form-label">Pickup Date</label>
                    <div class="invalid-feedback">
                        Provide a valid pickup date 
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="inputDropDate" name="dropDate" required>
                    <label for="inputDropDate" class="col-md-12 col-form-label">Drop-off Date</label>
                    <div class="invalid-feedback">
                        Provide a valid drop-off date 
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Select your car</button>
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
        
    </body>
</html>