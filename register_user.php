<?php
include('connection.php'); // Tu archivo de conexión con $dbc

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar datos
    $user = mysqli_real_escape_string($dbc, $_POST['username']);
    $pass = mysqli_real_escape_string($dbc, $_POST['pass']);
    $name = mysqli_real_escape_string($dbc, $_POST['fullname']);
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $addr = mysqli_real_escape_string($dbc, $_POST['address']);

    // Query de inserción (admin siempre es 0 por defecto para nuevos usuarios)
    $sql = "INSERT INTO Customer (user_name, password, full_name, email, address, admin) 
            VALUES (?, ?, ?, ?, ?, 0)";

    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("sssss", $user, $pass, $name, $email, $addr);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful! Please login.');
                window.location.href='user_login.php'; 
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($dbc);
}
?>
