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

    // Get variables for order
    $carID=$_POST["carID"];
    $pickupLocID=$_POST["pickupLocID"];
    $dropLocID=$_POST["dropLocID"];
    $pickDate=$_POST["pickDate"];
    $dropDate=$_POST["dropDate"];
    $totalCost=$_POST["totalCost"];
    $error="";
    $success="";

    // Login function
    function login($conn){
        // Get username and password
        $username=$_POST['username'];
        $password=$_POST['password'];

        // Set return flag
        $log_success = true;

        if($username!=""&&$password!=""){
            // Make query and get results
            $login_query="select*from client where username='$username' and password='$password';";
            $log_result=mysqli_query($conn,$login_query);

            // Check results
            if(!$log_result){
                die("Query Failed: " . mysqli_error($conn));
            }else{
                if(mysqli_num_rows($log_result)>0){
                    // Get first and last name, user id, and success message
                    $row=$log_result->fetch_assoc();
                    $firstname=$row["Fname"];
                    $lastname=$row["Lname"];
                    $user_id=$row["ID"];
                    
                    // Assign session variables
                    $_SESSION["fname"] = $firstname;
                    $_SESSION["lname"] = $lastname;
                    $_SESSION["user"] = $username;
                    $_SESSION["user_id"] = $user_id;

                    return $log_success;
                } else{
                    $log_success=false;
                    return $log_success;
                }
            }
        }        
    }

    // Order function
    function order($conn, $carID, $pickupLocID, $dropLocID, $pickDate, $dropDate, $totalCost){
        if (isset($_SESSION["user_id"])) {
            // Get the user id
            $user_id=$_SESSION["user_id"];
            
            // Set return flag
            $ord_success=true;
            
            if (isset($user_id)) {
                // Check if the user has already placed and order
                $check="select orderNo from order_details where client_ID=$user_id;";
                $check_result=mysqli_query($conn, $check);

                if(mysqli_num_rows($check_result)<1){
                    
                    if (isset($carID) && isset($pickupLocID) && isset($dropLocID) & isset($pickDate) && isset($dropDate) && isset($totalCost)) {
                        // Make query and get results
                        $insert="insert into order_details (client_ID, car_ID, pickup_date, drop_date, pickup_loc, drop_loc, total_cost) values('$user_id','$carID','$pickDate','$dropDate','$pickupLocID','$dropLocID','$totalCost');";
                        $add_result=$conn->query($insert);
        
                        // Check results
                        if (!$add_result) {
                            die("Query Failed: " . mysqli_error($conn));
                        } else {
                            return $ord_success;
                        }
                    }
                } else {
                    
                    return false;
                }
            }
        }
    }

    if (isset($_SESSION["user_id"])) {
        // Call the order function
        $ord_success=order($conn, $carID, $pickupLocID, $dropLocID, $pickDate, $dropDate, $totalCost);

        // Get output message
        if ($ord_success) {
            $success="Order Completed";
        } else{
            $error="Unable to complete your order";
        }
    } else {
        // Call the login function then the order function;
        $log_success=login($conn);
        $ord_success=order($conn, $carID, $pickupLocID, $dropLocID, $pickDate, $dropDate, $totalCost);

        // Get output message
        if ($ord_success && $log_success) {
            $success="Order Completed";
        } else{
            $error="Unable to complete your order";
        }
    }

    $conn->close();
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

        <title>
            <?php
                if($success){
                    echo "Order Successful";
                } else {
                    echo "Order Failed";
                }
            ?>
        </title>
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
                            
                            echo "<div class=\"row justify-content-center\">";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"list-orders.php\" class=\"redirect\">Check your orders</a></div>";
                            echo "</div>";
                        } else{
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1 class=\"display-3 text-light\">" . $error . "</h1></div></div>";

                            echo "<div class=\"row\">";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"javascript:javascript:history.go(-1)\" class=\"redirect\">Try again</a></div>";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"welcomePage.php\" class=\"redirect\">Pick a location to rent</a></div>";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"listings.php\" class=\"redirect\">Browse our fleet</a></div>";
                            echo "</div>";
                        }
                    ?>
                </div> 
            </div>
             
            
        </div> 
    </body>
</html>