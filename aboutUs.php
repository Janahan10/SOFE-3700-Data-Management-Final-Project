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

      <div class="logo-section">
        <h1 class="display-3 mt-5">About Us</h1><br>
        <h2 class="display-4">Our Partners</h2>

        <div class="icon">
          <a href="#p1"><img src="images/logo/Porsche-logo.jpg" alt=""></a>
          <a href="#p2"><img src="images/logo/Lamborghini-logo.jpg" alt=""></a>
          <a href="#p3"><img src="images/logo/Ferrari-logo.jpg" alt=""></a>
          <a href="#p4"><img src="images/logo/McLaren-logo.jpg" alt=""></a>
        </div>

        <div class="section" id="p1">
          <span class="name">Porsche</span>
          <p>
            Porsche honors are near endless. The German icon has 19 wins at the 24 Hours of Le Mans. It's often called the most prestigious automobile brand in the world. And the design, quality and authority are legendary.
          </p>
        </div>

        <div class="section" id="p2">
          <span class="name">Lamborghini</span>
          <p>
            Lamborghini vehicles rule the exotic automotive world. Extreme, exclusive, extraordinary define Lamborghini.
          </p>
        </div>

        <div class="section" id="p3">
          <span class="name">Ferrari</span>
          <p>
            Founded by Enzo Ferrari in Modena, Italy, in 1939, Ferrari is considered the world's most powerful brand comprising a driving style defined by speed, luxury, and wealth.
          </p>
        </div>

        <div class="section" id="p4">
          <span class="name">McLaren</span>
          <p>
            Conceived by Formula 1 driver Bruce McLaren from New Zealand, the exclusive and powerful coupe represents innovation at its best. Lightweight, fast, and British defines McLaren.
        </div>

      </div>

  </body>
</html>