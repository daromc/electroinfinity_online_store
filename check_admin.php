<!-- check admin file-->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('connection.php');

// 1. Si ni siquiera hay sesión, al login
if(!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['customer_id'];

// 2. Consultamos el campo 'admin' en tu tabla de usuarios
// Ajusta 'Customer' y 'customer_id' si tus nombres son diferentes
$sql = "SELECT admin FROM Customer WHERE customer_id = ?";
$stmt = $dbc->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

// 3. Verificamos si el campo es 1
if (!$user_data || $user_data['admin'] != 1) {
    echo "<div style='text-align:center; margin-top:50px; font-family:sans-serif; color:white; background:#0d1b2a; height:100vh; padding-top:100px;'>";
    echo "<h1 style='color:#ff4d4d;'>ACCESS DENIED</h1>";
    echo "<p>This area is restricted to administrators only.</p>";
    echo "<a href='index.php' style='color:#00d4ff;'>Return to Home</a>";
    echo "</div>";
    exit();
}
// Si llega aquí, es admin y la página add_product.php se cargará normal.
?>