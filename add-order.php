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

            if ($user_id && $carID && $pickupLocID && $dropLocID & $pickDate && $dropDate && $totalCost) {
                // Make query and get results
                $insert="insert into order_details (client_ID, car_ID, pickup_date, drop_date, pickup_loc, drop_loc, total_cost) values('$user_id','$carID','$pickDate','$dropDate','$pickupLocID','$dropLocID','$totalCost');";
                $add_result=$conn->query($insert);

                // Set return flag
                $ord_success=true;

                // Check results
                if (!$add_result) {
                    die("Query Failed: " . mysqli_error($conn));
                } else {
                    return $ord_success;
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

        <div class="container" style="margin-top: 12vw;">
            <div class="row justify-content-center">
                <div class="col-10">
                    <?php
                        // Check if there is a success or error message
                        // Print appropriate page
                        if($success){
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1>" . $success . "</h1></div></div>";
                            
                            echo "<div class=\"row justify-content-center\">";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"test.php\">Check your orders</a></div>";
                            echo "</div>";
                        } else{
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1>" . $error . "</h1></div></div>";

                            echo "<div class=\"row\">";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"javascript:javascript:history.go(-1)\">Try again</a></div>";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"welcomePage.php\">Pick a location to rent</a></div>";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"#\">Browse our fleet</a></div>";
                            echo "</div>";
                        }
                    ?>
                </div> 
            </div>
             
            
        </div> 
    </body>
</html>