<?php
// Forzar a PHP a mostrar el error real en pantalla
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connection.php');
include('check_admin.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Verificar si las variables están llegando
    if (!isset($_POST['cat_name']) || !isset($_POST['cat_des'])) {
        die("Error: Form data is missing.");
    }

    $categoryName = mysqli_real_escape_string($dbc, $_POST['cat_name']);
    $categoryDescription = mysqli_real_escape_string($dbc, $_POST['cat_des']);

    // 2. Insertar directamente (Asegúrate que los nombres de columnas coincidan)
    // He quitado el chequeo de duplicados por ahora para simplificar y hallar el error 500
    $sql = "INSERT INTO Category (category_name, description) VALUES (?, ?)";
    $stmt = $dbc->prepare($sql);
    
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $dbc->error);
    }

    $stmt->bind_param("ss", $categoryName, $categoryDescription);

    if ($stmt->execute()) {
        header("Location: add_category.php?status=success");
        exit();
    } else {
        // Esto nos dirá si falló por una columna mal escrita o un nombre de tabla erróneo
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

} else {
    echo "No se recibió una solicitud POST.";
}
?>