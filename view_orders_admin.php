<?php
include('connection.php');
include('check_admin.php'); // Seguridad: Solo el admin tiene permiso
include('header.php');

// Consulta SQL con JOIN para obtener los datos del cliente junto con la orden
$sql = "SELECT o.order_id, o.order_date, o.total_amount, o.shipping_address, o.phone_number, 
               c.full_name, c.email 
        FROM Orders o
        JOIN Customer c ON o.customer_id = c.customer_id
        ORDER BY o.order_date DESC";

$result = mysqli_query($dbc, $sql);
?>

<style>
    body { background-color: #0d1b2a; color: white; } /* Manteniendo tu estilo oscuro */
    .admin-card { 
        background-color: #1b263b; 
        border: none; 
        border-radius: 15px; 
    }
    .table { color: #e0e1dd !important; }
    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.05) !important;
    }
    .thead-custom { background-color: #415a77; color: white; }
    .badge-price { font-size: 1rem; color: #57cc99; }
</style>

<div class="container-fluid mt-5 mb-5 px-5">
    <div class="card admin-card shadow-lg">
        <div class="card-header bg-dark d-flex justify-content-between align-items-center p-3">
            <h3 class="mb-0 text-info"><i class="bi bi-shield-lock-fill"></i> Admin: Global Order Management</h3>
            <span class="badge bg-primary px-3 py-2">Total Orders: <?php echo mysqli_num_rows($result); ?></span>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-custom">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Info</th>
                            <th>Date & Time</th>
                            <th>Shipping Address</th>
                            <th>Total Amount</th>
                            <th class="text-center">Invoice Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><span class="fw-bold text-info">#<?php echo $row['order_id']; ?></span></td>
                                <td>
                                    <div class="fw-bold"><?php echo htmlspecialchars($row['full_name']); ?></div>
                                    <div class="small text-muted"><?php echo htmlspecialchars($row['email']); ?></div>
                                </td>
                                <td><?php echo date('M d, Y - H:i', strtotime($row['order_date'])); ?></td>
                                <td>
                                    <div class="small text-truncate" style="max-width: 200px;">
                                        <?php echo htmlspecialchars($row['shipping_address']); ?>
                                    </div>
                                    <div class="small text-muted"><i class="bi bi-telephone"></i> <?php echo $row['phone_number']; ?></div>
                                </td>
                                <td><span class="badge-price fw-bold">$<?php echo number_format($row['total_amount'], 2); ?></span></td>
                                <td class="text-center">
                                    <a href="orders/order_<?php echo $row['order_id']; ?>.pdf" 
                                       target="_blank" 
                                       class="btn btn-outline-danger btn-sm px-3">
                                        <i class="bi bi-file-earmark-pdf"></i> View PDF
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <h4 class="text-muted">No orders found in the database.</h4>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
