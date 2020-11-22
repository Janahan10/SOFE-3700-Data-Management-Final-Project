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

  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!--
  insert the website title here
  -->
  <div class="main_container">

    <h1>Your Orders</h1>
      <!-- Insert the list of orders here (aka the php code) -->
    <section>
      <!-- function that generates order details depending on
      how many user orders there are -->

        <summary > Order Number </summary>
        <?php $sql = "SELECT * FROM order_details;"; //connect the client ID from the check user file to specify
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo $row['orderNo'] . "<br>";

      }
    }
         ?>

        <details>
        <summary> Car ID </summary>
        <?php $sql = "SELECT * FROM order_details;"; //connect the client ID from the check user file to specify
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo $row['car_ID'] . "<br>";

      }
    }
         ?>
      </details>

      <details>
        <summary> Total Cost </summary>
        <?php $sql = "SELECT * FROM order_details;"; //connect the client ID from the check user file to specify
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo $row['total_cost'] . "<br>";

      }
    }
         ?>
      </details>
      <details>
        <summary> Pickup Location </summary>
        <?php $sql = "SELECT * FROM order_details;"; //connect the client ID from the check user file to specify
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo $row['pickup_loc'] . "<br>";

      }
    }
         ?>
      </details>
      <details>
        <summary> Dropoff Location </summary>
        <?php $sql = "SELECT * FROM order_details;"; //connect the client ID from the check user file to specify
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo $row['drop_loc'] . "<br>";

      }
    }
         ?>
      </details>
      <details>
        <summary> Pickup/Dropoff Date</summary>
        <?php $sql = "SELECT * FROM order_details;"; //connect the client ID from the check user file to specify
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
          echo $row['pickup_date']," ",$row['drop_date'] . "<br>";

      }
    }
         ?>
      </details>
      <button>Return </button> <!-- put an onclick function is needed -->
    </section>
  </div>
</body>
</html>
