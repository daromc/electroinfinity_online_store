<!-- check admin file-->

<?php
session_start();
// ---- Check if you are admin or not ---------------------------------------------------------------------------------
if(!isset($_SESSION['username'])) {
    echo "<h5>You are not allowed to access to this page. Please login as admin.</h5>";
    echo "<h5>Please login as admin.</h5>";
    echo "Go back to <a href='login.php'>LOGIN</a>";
    // Use exit() to hide add_product.php from non-admin users
    exit();
  }
// --------------------------------------------------------------------------------------------------------------------

?>