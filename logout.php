<?php
// 1. Iniciar la sesión para poder destruirla
session_start();

// 2. Limpiar todas las variables de sesión
$_SESSION = array();

// 3. Destruir la sesión en el servidor
session_destroy();

// 4. Redirigir inmediatamente a la página de login
header("Location: user_login.php");

// 5. Asegurar que el script se detenga aquí
exit();
?>