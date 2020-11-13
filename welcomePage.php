<?php
    $servername = "localhost";
    $username = "user";
    $password = "password";
    $dbname = "car_rental";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, firstname, lastname FROM MyGuests";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
    } else {
    echo "0 results";
    }
    $conn->close();
?>

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
        <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
            <a class="navbar-brand" href="welcomePage.html">Logo</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </nav>
        <div class="jumbotron">
            <div class="text-center mx-3 my-3">
                <h1>Book Your Rental Today</h1>
            </div>
            <form class="container px-3 py-3" action="#" method="post">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="inputPickupLoc" class="col-md-10 col-form-label">Pick a Location</label>
                        <select id="inputPickupLoc" class="form-control">
                            <option selected>TBD</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="inputPickupDate">
                        <label for="inputPickupDate" class="col-md-12 col-form-label">Pickup Date</label>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="inputDropDate">
                        <label for="inputDropDate" class="col-md-12 col-form-label">Dropoff Date</label>
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