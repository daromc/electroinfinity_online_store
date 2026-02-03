<?php 
include('connection.php'); 
include('header.php'); // El header ya tiene session_start()

// Redirigir si no hay sesión
if (!isset($_SESSION['customer_id'])) {
    header("Location: user_login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
?>

<div class="container col-sm-12 col-md-12">
    <div class="table-responsive mt-5">
        <table class="table table-bordered text-white" style="background-color: rgba(0,0,0,0.8);">
            <thead class="thead-light text-dark">
                <tr class="table-light">
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub-Total</th>
                    <th>+1</th>
                    <th>-1</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                <?php
                $total = 0;
                
                // QUERY CON JOIN PARA TRAER DATOS DE PRODUCTO Y CANTIDAD DEL CARRITO
                $sql = "SELECT p.product_id, p.product_name, p.product_image, p.product_price, sc.quantity 
                        FROM ShoppingCart sc 
                        JOIN Product p ON sc.product_id = p.product_id 
                        WHERE sc.customer_id = ?";
                
                $stmt = $dbc->prepare($sql);
                $stmt->bind_param("i", $customer_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['product_id'];
                        $qty = $row['quantity'];
                        $subtotal = $row['product_price'] * $qty;
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><img src="<?php echo $row['product_image']; ?>" width="50"></td>
                            <td>$<?php echo number_format($row['product_price'], 2); ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td><a href="cart_db_manage.php?action=add&pid=<?php echo $id; ?>" class="btn btn-sm btn-success">+</a></td>
                            <td><a href="cart_db_manage.php?action=minus&pid=<?php echo $id; ?>" class="btn btn-sm btn-warning">-</a></td>
                            <td><a href="cart_db_manage.php?action=remove&pid=<?php echo $id; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='py-5'><h4>Your Cart is empty</h4></td></tr>";
                }
                
                $tax = $total * 0.15; 
                $grandTotal = $total + $tax;
                ?>

                <tr class="table-dark">
                    <td colspan="4" class="text-end">Tax (15%)</td>
                    <td>$<?php echo number_format($tax, 2); ?></td>
                    <td colspan="3"></td>
                </tr>
                <tr class="table-primary text-dark">
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php if ($total > 0): ?>
        <div class="text-end mb-5">
            <a href="index.php" class="btn btn-outline-light">Continue Shopping</a>
            <a href="check_out_verify.php" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>