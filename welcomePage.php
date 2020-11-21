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
        <div class="jumbotron">
            <div class="text-center mx-3 my-3">
                <h1>Book Your Rental Today</h1>
            </div>
            <form class="container px-3 py-3" action="listings.php" method="get">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="inputPickupLoc" class="col-md-10 col-form-label">Pick a Location</label>
                        <select id="inputPickupLoc" class="form-control" name="pickupLocID">
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
                        <input type="date" class="form-control" id="inputPickupDate" name="pickDate">
                        <label for="inputPickupDate" class="col-md-12 col-form-label">Pickup Date</label>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="inputDropDate" name="dropDate">
                        <label for="inputDropDate" class="col-md-12 col-form-label">Drop-off Date</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Select your car</button>
                    </div>
                </div>
            </form>
        </div>
        
    </body>
</html>