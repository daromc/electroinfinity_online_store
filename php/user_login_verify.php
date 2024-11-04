<!-- user login_verify file -->

<?php
session_start();

$username = $_POST['username'];
$password = $_POST['pass'];

include('connection.php');

// Query only administrators and save the $sql variable
$sql = "SELECT * FROM Customer WHERE user_name = ? AND password = ? AND admin = 0";
$stmt = $dbc->prepare($sql);

// The "ss" indicates that the two parameters are of type string, meaning that $username and $password will be treated as strings.
$stmt->bind_param("ss", $username, $password);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();



if($result && $result->num_rows > 0) {
    echo "<p>Login successful</p>";
    $_SESSION['username'] = $username;
    echo "<h3>Hi, <strong>$username</strong>, you have successfully logged in to our system </h3>";
    echo "<p>Please proceed to our <a href='startpage.php'>STARTPAGE</a></p>";
} else {
    echo "<p>Login failed.</p>";
    echo "<p>Incorrect username or password.</p>";
    echo "<h4>Please <a href='user_login.php'>TRY AGAIN</a></h4>";
}

?>
