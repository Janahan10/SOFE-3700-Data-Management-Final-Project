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

    //set variables based on names in the html
    $username=$_POST['username'];
    $password=$_POST['password'];
    $error="";
    $success="";
    if($username!=""&&$password!=""){
        // Make query and get results
        $query="select*from client where username='$username' and password='$password';";
        $result=mysqli_query($conn,$query);

        // Check results
        if(!$result){
            die("Query Failed: " . mysqli_error($conn));
        }else{
            if(mysqli_num_rows($result)>0){
                // Get first and last name, user id, and success message
                $row=$result->fetch_assoc();
                $firstname=$row["Fname"];
                $lastname=$row["Lname"];
                $user_id=$row["ID"];
                $success="Welcome, $firstname $lastname";
                
                // Assign session variables
                $_SESSION["fname"] = $firstname;
                $_SESSION["lname"] = $lastname;
                $_SESSION["user"] = $username;
                $_SESSION["user_id"] = $user_id;
            }else{
                $error="The username or password you entered is incorrect";
            }
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

        <title>Sign in</title>
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
                            // echo "<div class=\"row text-center\">";
                            // echo "<div class=\"col-12 text-center\">";
                            // echo "<h1>" . $success . "</h1>";
                            // echo "</div></div>";
                            // echo "<div class=\"row\">";

                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1>" . $success . "</h1></div></div>";
                            
                            echo "<div class=\"row\">";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"welcomePage.php\">Pick a location to rent</a></div>";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"#\">Browse our fleet</a></div>";
                            echo "<div class=\"col-4 mt-5 text-center\"><a href=\"test.php\">Check your orders</a></div>";
                            echo "</div>";
                        } else{
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1>" . $error . "</h1></div></div>";

                            echo "<div class=\"row\">";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"sign-in.html\">Log in again</a></div>";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"sign-up.html\">Create a new account</a></div>";
                            echo "</div>";
                        }
                    ?>
                    <!-- <div class="row text-center">
                        <div class="col-12 text-center">
                            <h1>Welcome Fname Lname</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-5 text-center">
                            <a href="welcomePage.php">Pick a location to rent</a>
                        </div>
                        <div class="col-4 mt-5 text-center">
                            <a href="#">Browse our fleet</a>
                        </div>
                        <div class="col-4 mt-5 text-center">
                            <a href="#">Check your orders</a>
                        </div>
                    </div> -->
                    <!-- <div class="row text-center">
                        <div class="col-12 text-center">
                            <h1>User does not exist</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-5 text-center">
                            <a href="sign-in.html">Log in again</a>
                        </div>
                        <div class="col-6 mt-5 text-center">
                            <a href="sign-up.html">Create a new account</a>
                        </div>
                    </div> -->
                </div> 
            </div>
             
            
        </div> 
    </body>
</html>