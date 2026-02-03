<?php
session_start();
include('connection.php');
require('fpdf.php'); // Asegúrate de tener este archivo

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $address = mysqli_real_escape_string($dbc, $_POST['address']);
    $phone = mysqli_real_escape_string($dbc, $_POST['phone']);

    // 1. Recalcular Totales
    $sql_cart = "SELECT sc.product_id, sc.quantity, p.product_name, p.product_price 
                 FROM ShoppingCart sc JOIN Product p ON sc.product_id = p.product_id 
                 WHERE sc.customer_id = ?";
    $stmt = $dbc->prepare($sql_cart);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $subtotal = 0;
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $subtotal += $row['product_price'] * $row['quantity'];
        $items[] = $row;
    }
    
    $tax = $subtotal * 0.15;
    $shipping = $subtotal * 0.10;
    $grand_total = $subtotal + $tax + $shipping;

    // 2. Insertar en tabla Orders
    $sql_order = "INSERT INTO Orders (customer_id, total_amount, shipping_address, phone_number) VALUES (?, ?, ?, ?)";
    $stmt_o = $dbc->prepare($sql_order);
    $stmt_o->bind_param("idss", $customer_id, $grand_total, $address, $phone);
    $stmt_o->execute();
    $order_id = $dbc->insert_id;

    // 3. Insertar en OrderDetails
    foreach ($items as $item) {
        $sql_det = "INSERT INTO OrderDetails (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)";
        $stmt_d = $dbc->prepare($sql_det);
        $stmt_d->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['product_price']);
        $stmt_d->execute();
    }

    // 4. GENERAR PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'ELECTROINFINITY - INVOICE', 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Order ID: #$order_id", 0, 1);
    $pdf->Cell(0, 10, "Customer: " . $_SESSION['username'], 0, 1);
    $pdf->Cell(0, 10, "Phone: $phone", 0, 1);
    $pdf->MultiCell(0, 10, "Shipping Address: $address");
    $pdf->Ln(5);

    // Tabla de productos
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(100, 10, 'Product', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Qty', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Price', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

    foreach ($items as $item) {
        $pdf->Cell(100, 10, $item['product_name'], 1);
        $pdf->Cell(30, 10, $item['quantity'], 1, 0, 'C');
        $pdf->Cell(30, 10, "$" . $item['product_price'], 1, 0, 'C');
        $pdf->Cell(30, 10, "$" . ($item['product_price'] * $item['quantity']), 1, 1, 'C');
    }

    $pdf->Ln(5);
    $pdf->Cell(160, 10, 'Subtotal:', 0, 0, 'R');
    $pdf->Cell(30, 10, "$" . number_format($subtotal, 2), 0, 1, 'R');
    $pdf->Cell(160, 10, 'Tax (15%):', 0, 0, 'R');
    $pdf->Cell(30, 10, "$" . number_format($tax, 2), 0, 1, 'R');
    $pdf->Cell(160, 10, 'Shipping (10%):', 0, 0, 'R');
    $pdf->Cell(30, 10, "$" . number_format($shipping, 2), 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(160, 10, 'GRAND TOTAL:', 0, 0, 'R');
    $pdf->Cell(30, 10, "$" . number_format($grand_total, 2), 0, 1, 'R');

    // Guardar el PDF en la carpeta /orders
    $filename = "orders/order_" . $order_id . ".pdf";
    $pdf->Output('F', $filename);

    // 5. VACIAR EL CARRITO
    $sql_clear = "DELETE FROM ShoppingCart WHERE customer_id = ?";
    $stmt_c = $dbc->prepare($sql_clear);
    $stmt_c->bind_param("i", $customer_id);
    $stmt_c->execute();

    // 6. Redirigir al éxito
    header("Location: order_success.php?id=$order_id");
    exit();
}
