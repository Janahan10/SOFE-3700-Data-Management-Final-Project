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

        <title>Welcome to Canada Cars</title>
    </head>

    <body style="background-image: url(images/front.jpg); background-position: center; background-size: cover;">
    <nav class="navbar navbar-expand-md navbar-dark">
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
    <div class="jumbotron mb-0" style="background-color:rgba(9, 0, 0, 0.5);">
        <div class=" row justify-content-center mx-3 mt-3 mb-0">
            <h1 class="display-2 text-light">CANADA </h1><h1 class="display-2 text-light font-weight-bold"> CARS</h1>
        </div>
        <div class=" row justify-content-center mx-3 mb-1 p-0">
            <h2 class="text-light">Here is where your route begins</h2>
        </div>
        <form class="container px-3 py-3 needs-validation" action="listings.php" method="get" novalidate>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="inputPickupLoc" class="col-md-10 col-form-label text-light">Pick a Location</label>
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
                    <label for="inputPickupDate" class="col-md-12 col-form-label text-light">Pickup Date</label>
                    <div class="invalid-feedback">
                        Provide a valid pickup date 
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="inputDropDate" name="dropDate" required>
                    <label for="inputDropDate" class="col-md-12 col-form-label text-light">Drop-off Date</label>
                    <div class="invalid-feedback">
                        Provide a valid drop-off date 
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary bg-light border-0 text-dark">Select your car</button>
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

    <div class="card-group">
        <div class="card">
        <img class="card-img-top" src="images/tripadvisor.png" alt="tripadvisor logo">
        <div class="card-body">
            <h5 class="card-title">5 Star Average Rating</h5>
            <p class="card-text">5 star rating based on over 1,500 reviews from loyal and new customers alike.</p>

        </div>
        </div>
        <div class="card">
        <img class="card-img-top" src="images/google.jpg" alt="google logo">
        <div class="card-body">
            <h5 class="card-title">"Best customer service ever!"</h5>
            <p class="card-text">These guys are some of the best in the car rental game. Definitely will be back!</p>

        </div>
        </div>
        <div class="card">
        <img class="card-img-top" src="images/facebook.png" alt="facebook logo">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>

        </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="images/yelp.jpg" alt="yelp logo">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>

            </div>
        </div>
    </div>
        
    </body>
</html>