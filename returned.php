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

    $error="";
    $success="";

    if (isset($_POST["orderNo"]) && isset($_POST["car_ID"]) && isset($_POST["dropLocID"])) {
        // Get variables
        $orderNo=$_POST["orderNo"];
        $car_ID=$_POST["car_ID"];
        $dropLocID=$_POST["dropLocID"];

        // Make a query to delete the results
        $delete="delete from order_details where orderNo=$orderNo;";
        $delete_result=mysqli_query($conn, $delete);

        // make a query to change the location that the car is stored in
        $switch="update stored_in set loc_No=$dropLocID where car_ID=$car_ID;";
        $switch_result=mysqli_query($conn, $switch);

        if (!$switch_result && !$delete_result) {
            $error="Unable to return your order";
        } else {
            $success="Thank you for renting with us";
        }
    }else {
        $error="This didn't work at all";
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

        <title>Order Return</title>
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

        <div class="container" style="margin-top: 12vw;">
            <div class="row justify-content-center">
                <div class="col-10">
                    <?php
                        // Check if there is a success or error message
                        // Print appropriate page
                        if($success){
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1 class=\"display-3 text-light\">" . $success . "</h1></div></div>";
                            
                            echo "<div class=\"row justify-content-around\">";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"listings.php\" class=\"redirect\">Look at more vehicles</a></div>";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"logout.php\" class=\"redirect\">Sign out</a></div>";
                            echo "</div>";
                        } else{
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1 class=\"display-3 text-light\">" . $error . "</h1></div></div>";

                            echo "<div class=\"row\">";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"list-orders.php\" class=\"redirect\">Check your order again</a></div>";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"logout.php\" class=\"redirect\">Sign out</a></div>";
                            echo "</div>";
                        }
                    ?>
                </div> 
            </div>
        </div> 
    </body>
</html>