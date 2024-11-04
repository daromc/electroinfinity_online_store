<!-- admin startpage file -->

<?php

include('header_admin.php');

session_start();
if (!isset($_SESSION['username'])) {
	echo "<h3>You are not logged in!</h3>";
	echo "Please go back to <a href='login.php'>LOGIN</a>";
}else {
	$username = $_SESSION['username'];
	echo "<h2>Welcome to the Start Page for this Website</h2>";
	echo "Current User: <strong>$username</strong><br /><P>";
}

include('footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
