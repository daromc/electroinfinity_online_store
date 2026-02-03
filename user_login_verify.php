<!-- user login_verify file -->

<?php
session_start();

include('connection.php');

$username = $_POST['username'];
$password = $_POST['pass'];

// 1. Consultamos al usuario
$sql = "SELECT * FROM Customer WHERE user_name = ? AND password = ? AND admin = 0";
$stmt = $dbc->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if($result && $result->num_rows > 0) {
    // 2. ¡IMPORTANTE! Extraemos la fila para obtener el ID real de la DB
    $row = $result->fetch_assoc(); 

    // 3. Guardamos los datos en la sesión
    $_SESSION['username'] = $row['user_name'];
    $_SESSION['customer_id'] = $row['customer_id']; // Ahora sí el carrito funcionará
    
    // 4. Redirección automática al Home
    header("Location: index.php"); 
    exit(); 

} else {
    echo "<p>Login failed. Incorrect username or password.</p>";
    echo "<h4>Please <a href='user_login.php'>TRY AGAIN</a></h4>";
}
?>
