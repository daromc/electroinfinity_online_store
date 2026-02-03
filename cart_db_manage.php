<?php
session_start();
include('connection.php');

// 1. Seguridad: Verificar que el usuario esté logueado
if (!isset($_SESSION['customer_id'])) {
    header("Location: user_login.php?msg=Please login to manage your cart");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$product_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

// 2. Solo actuamos si tenemos un ID de producto válido
if ($product_id > 0) {

    switch ($action) {
        case 'add':
            // Si el producto existe, suma 1; si no, lo inserta
            $sql = "INSERT INTO ShoppingCart (customer_id, product_id, quantity) 
                    VALUES (?, ?, 1) 
                    ON DUPLICATE KEY UPDATE quantity = quantity + 1";
            $stmt = $dbc->prepare($sql);
            $stmt->bind_param("ii", $customer_id, $product_id);
            $stmt->execute();
            break;

        case 'minus':
            // Resta 1, pero solo si la cantidad es mayor a 1
            $sql = "UPDATE ShoppingCart SET quantity = quantity - 1 
                    WHERE customer_id = ? AND product_id = ? AND quantity > 1";
            $stmt = $dbc->prepare($sql);
            $stmt->bind_param("ii", $customer_id, $product_id);
            $stmt->execute();
            
            // Opcional: Si quieres que al llegar a 0 se borre, podrías añadir un DELETE aquí
            break;

        case 'remove':
            // Borra el registro completo
            $sql = "DELETE FROM ShoppingCart WHERE customer_id = ? AND product_id = ?";
            $stmt = $dbc->prepare($sql);
            $stmt->bind_param("ii", $customer_id, $product_id);
            $stmt->execute();
            break;
    }
}

// 3. Redirección inteligente
// Si venimos del carrito, volvemos al carrito. Si no, al index.
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: view_cart.php");
}
exit();
