<?php
session_start();
include('connection.php');
include('check_admin.php');

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // 1. Borrar primero la relación en la tabla intermedia (categoryProduct)
    // Esto es vital para evitar errores de llave foránea
    $sql_cat = "DELETE FROM categoryProduct WHERE product_id = ?";
    $stmt_cat = $dbc->prepare($sql_cat);
    $stmt_cat->bind_param("i", $product_id);
    $stmt_cat->execute();

    // 2. Borrar el producto de la tabla Product
    $sql_prod = "DELETE FROM Product WHERE product_id = ?";
    $stmt_prod = $dbc->prepare($sql_prod);
    $stmt_prod->bind_param("i", $product_id);

    if ($stmt_prod->execute()) {
        header("Location: delete_product.php?msg=Product deleted successfully");
    } else {
        header("Location: delete_product.php?msg=Error deleting product: " . $dbc->error);
    }
    exit();
} else {
    header("Location: delete_product.php");
    exit();
}
