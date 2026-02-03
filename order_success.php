<?php
include('connection.php');
include('header.php');

if (!isset($_GET['id']) || !isset($_SESSION['customer_id'])) {
    header("Location: index.php");
    exit();
}

$order_id = intval($_GET['id']);
$customer_id = $_SESSION['customer_id'];

// Consultar los datos de la orden para el resumen
$sql_order = "SELECT * FROM Orders WHERE order_id = ? AND customer_id = ?";
$stmt_o = $dbc->prepare($sql_order);
$stmt_o->bind_param("ii", $order_id, $customer_id);
$stmt_o->execute();
$order = $stmt_o->get_result()->fetch_assoc();

if (!$order) {
    echo "<div class='container mt-5'><h2>Order not found.</h2></div>";
    exit();
}

// Consultar los detalles de los productos comprados
$sql_details = "SELECT od.*, p.product_name 
                FROM OrderDetails od 
                JOIN Product p ON od.product_id = p.product_id 
                WHERE od.order_id = ?";
$stmt_d = $dbc->prepare($sql_details);
$stmt_d->bind_param("i", $order_id);
$stmt_d->execute();
$details = $stmt_d->get_result();
?>

<style>
    body { background-color: #0d1b2a; color: white; }
    .success-card { background-color: white; color: #333; border-radius: 20px; padding: 40px; }
    .invoice-box { border: 1px solid #eee; padding: 20px; border-radius: 10px; background-color: #f9f9f9; }
    .check-icon { font-size: 4rem; color: #198754; }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="success-card shadow-lg text-center">
                <i class="bi bi-check-circle-fill check-icon"></i>
                <h1 class="display-5 fw-bold mt-3">Congratulations!</h1>
                <p class="lead">You have successfully purchased these items.</p>
                
                <hr>

                <div class="invoice-box text-start mt-4">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold text-muted">Order ID: #<?php echo $order_id; ?></span>
                        <span class="text-muted"><?php echo date('M d, Y', strtotime($order['order_date'])); ?></span>
                    </div>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $subtotal = 0;
                            while($item = $details->fetch_assoc()): 
                                $line_total = $item['price_at_purchase'] * $item['quantity'];
                                $subtotal += $line_total;
                            ?>
                            <tr>
                                <td><?php echo $item['product_name']; ?></td>
                                <td class="text-center"><?php echo $item['quantity']; ?></td>
                                <td class="text-end">$<?php echo number_format($line_total, 2); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <div class="border-top pt-3 mt-3">
                        <div class="d-flex justify-content-between small">
                            <span>Subtotal:</span>
                            <span>$<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between small text-danger">
                            <span>Tax (15%):</span>
                            <span>$<?php echo number_format($subtotal * 0.15, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between small text-primary">
                            <span>Shipping (10%):</span>
                            <span>$<?php echo number_format($subtotal * 0.10, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between h4 fw-bold mt-2">
                            <span>Total Paid:</span>
                            <span>$<?php echo number_format($order['total_amount'], 2); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-sm-6 mb-3">
                        <a href="index.php" class="btn btn-outline-dark btn-lg w-100">
                            <i class="bi bi-house-door"></i> Back to Store
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="orders/order_<?php echo $order_id; ?>.pdf" target="_blank" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-file-earmark-pdf"></i> Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
