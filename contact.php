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
?>

<!DOCTYPE html>
<html>
    <head>
       <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- SCRIPTS -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body id="contactPage" class="bg-dark">
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

          <div class="contact-title">
            <h1 class="display-2">Contact Us</h1><br>
            <h2 class="font-weight-light">Our main headquarters is located in Oshawa’s luxury car district at 2000 Simcoe St North. This location is known for premier automotive sales and service in Ontario. Our location is also available for private functions, film and TV hosting. Please inquire for availability.</h2>
          </div>

          <div class="cards-container">
            <div class="row justify-content-around">
              <div class="col-3">
                <div class="contact-info">
                  <h1>Contact Information</h1><br>
                  <h2>Address:  2000 Simcoe St N, Oshawa</h2>
                  <h2>Phone:  (905) 721-8668</h2>
                  <h2>Email:  car.rental@gamil.com</h2>
                </div>
              </div>
              <div class="col-6">
                <div class="contact-form">
                  <form id="contact-form" method="POST" action="email.php">
                    <input type="text" name="name" class="form-control" placeholder="Name" required><br>
      
                    <input type="email" name="email" class="form-control" placeholder="Email" required><br>
                    
                    <input type="sub" name="subject" class="form-control" placeholder="Subject" required><br>
      
                    <textarea name="message" class="form-control" placeholder="Message" rows="4" required></textarea><br>
      
                    <input type="submit" class="form-control btn btn-lg btn-primary bg-light border-0 text-dark" value="Send Message">
                  </form>
                </div>
              </div>
              <div class="col-3">
                <div class="office-hours">
                  <h1>Office Hours</h1><br>
                  <h2>Mon:  10:00am - 6:00pm</h2>
                  <h2>Tue:  10:00am - 6:00pm</h2>
                  <h2>Wed:  10:00am - 6:00pm</h2>
                  <h2>Thu:  10:00am - 6:00pm</h2>
                  <h2>Fri:  10:00am - 6:00pm</h2>
                  <h2>Sat:  Closed - By Appointment Only</h2>
                  <h2>Sun:  Closed - By Appointment Only</h2>
                </div>
              </div>
            </div>
          </div>


          

          

          
    </body>
</html>