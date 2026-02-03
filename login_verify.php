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
    // 1. Extraer la fila de la base de datos
    $row = $result->fetch_assoc(); 

    // 2. Guardar los datos en la sesión
    $_SESSION['username'] = $row['user_name'];
    $_SESSION['customer_id'] = $row['customer_id'];
    $_SESSION['admin'] = $row['admin']; // <--- ESTO ES LO QUE FALTA (valdrá 1)

    // 3. Redirigir de inmediato (opcional, pero recomendado para que el header cargue limpio)
    header("Location: index.php");
    exit();

} else {
    // Login failed as admin user
    echo "<p>Login failed.</p>";
	echo "<p>You must be an administrator to log in.</p>";
	echo "<h4>Please <a href='login.php'>TRY AGAIN</a>";
}

?>

