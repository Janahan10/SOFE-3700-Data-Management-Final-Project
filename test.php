<?php

    if($_POST['pickupLoc'] and $_POST['pickDate'] and $_POST['dropDate'])
    {
        echo $_POST['pickupLoc'] . " " . $_POST['pickDate'] . " " . $_POST['dropDate'];
    }
?>