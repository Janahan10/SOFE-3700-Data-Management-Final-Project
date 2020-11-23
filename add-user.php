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
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $phone=$_POST["phone"];
    $d_license=$_POST["dNo"];
    $bdate=$_POST["dob"];
    $email=$_POST["email"];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $error="";
    $success="";
    if(isset($fname) && isset($lname) && isset($phone) && isset($d_license) && isset($bdate) && isset($email) && isset($username) && isset($password)){
        // Make query and get results
        $insert="insert into client (username, password, Fname, Lname, Bdate, phone_No, Email, D_license) values('$username','$password','$fname','$lname','$bdate','$phone','$email','$d_license');";
        $result=$conn->query($insert);

        // Check results
        if (!$result) {
            echo $result;
            $error="Unable to make an account";
        } else {
            $success="Thanks for joining";

            // Get and set the details for this session
            $_SESSION["fname"] = $fname;
            $_SESSION["lname"] = $lname;
            $_SESSION["user"] = $username;

            // Get user id and set into session
            $fetch_id=mysqli_query($conn, "select ID from client where username='$username' and password='$password';");
            $row=$fetch_id->fetch_assoc();
            $user_id=$row["ID"];
            $_SESSION["user_id"] = $user_id;
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
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1>" . $success . "</h1></div></div>";

                            echo "<div class=\"row\">";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"welcomePage.php\">Pick a location to rent</a></div>";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"listings.php\">Browse our fleet</a></div>";
                            echo "</div>";
                        } else{
                            echo "<div class=\"row text-center\"><div class=\"col-12 text-center\"><h1>" . $error . "</h1></div></div>";

                            echo "<div class=\"row\">";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"sign-in.html\">Log in</a></div>";
                            echo "<div class=\"col-6 mt-5 text-center\"><a href=\"sign-up.html\">Create a new account</a></div>";
                            echo "</div>";
                        }
                    ?>
                </div> 
            </div>
             
            
        </div> 
    </body>
</html>