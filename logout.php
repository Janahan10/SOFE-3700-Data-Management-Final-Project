<?php
// start the session then destroy the session to log out
session_start();
session_destroy();

// Redirect to the welcome page
header("Location: welcomePage.php");

exit;
?>