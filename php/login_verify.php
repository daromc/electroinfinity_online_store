<!-- login_verify -->

<?php
session_start();

$username = $_POST['username'];
$password = $_POST['pass'];

include('connection.php');

// Query only administrators and save the $sql variable
$sql = "SELECT * FROM Customer WHERE user_name = ? AND password = ? AND admin = 1";
$stmt = $dbc->prepare($sql);

// The "ss" indicates that the two parameters are of type string, meaning that $username and $password will be treated as strings.
$stmt->bind_param("ss", $username, $password);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if the login was successful
if ($result->num_rows > 0) {
    // Successfully logged in as admin user
    echo "Login successful. Welcome administrator!";
	$_SESSION['username'] = $username;
	echo "<h3>Hi, <strong>$username</strong>, you have successfully logged in to our system </h3>";
	echo "<p>Please proceed to our <a href='startpage.php'>STARTPAGE</p>";

} else {
    // Login failed as admin user
    echo "<p>Login failed.</p>";
	echo "<p>You must be an administrator to log in.</p>";
	echo "<h4>Please <a href='login.php'>TRY AGAIN</a>";
}

?>

