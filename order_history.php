<?php
include('connection.php');
include('header.php');

// Seguridad: Redirigir si no hay sesión iniciada
if (!isset($_SESSION['customer_id'])) {
    header("Location: user_login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Consulta para obtener el historial de órdenes del cliente logueado
$sql = "SELECT order_id, order_date, total_amount, shipping_address, phone_number 
        FROM Orders 
        WHERE customer_id = ? 
        ORDER BY order_date DESC";

$stmt = $dbc->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
    body { background-color: #0d1b2a; color: white; }
    .history-container { 
        background-color: rgba(255, 255, 255, 0.05); 
        padding: 40px; 
        border-radius: 15px; 
        margin-top: 50px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .table { color: white !important; }
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: white !important;
    }
    .status-badge {
        background-color: #198754;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
    }
</style>

<div class="container mb-5">
    <div class="history-container shadow-lg">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-clock-history text-info"></i> Your Order History</h2>
            <a href="index.php" class="btn btn-outline-info btn-sm">
                <i class="bi bi-plus-circle"></i> New Purchase
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Shipping Address</th>
                        <th>Status</th>
                        <th>Total Paid</th>
                        <th class="text-center">Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><strong>#<?php echo $row['order_id']; ?></strong></td>
                                <td><?php echo date('M d, Y - H:i', strtotime($row['order_date'])); ?></td>
                                <td class="small">
                                    <?php echo htmlspecialchars($row['shipping_address']); ?><br>
                                    <small class="text-muted"><i class="bi bi-telephone"></i> <?php echo $row['phone_number']; ?></small>
                                </td>
                                <td><span class="status-badge">Completed</span></td>
                                <td class="fw-bold text-info">$<?php echo number_format($row['total_amount'], 2); ?></td>
                                <td class="text-center">
                                    <a href="orders/order_<?php echo $row['order_id']; ?>.pdf" 
                                       target="_blank" 
                                       class="btn btn-danger btn-sm shadow-sm">
                                        <i class="bi bi-file-earmark-pdf"></i> View PDF
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-bag-x mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                                <p class="lead">You haven't made any purchases yet.</p>
                                <a href="index.php" class="btn btn-primary">Start Shopping</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
