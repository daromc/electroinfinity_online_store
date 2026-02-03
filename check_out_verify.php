<?php
include('connection.php');
include('header.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: user_login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// 1. Obtener datos base del usuario
$user_sql = "SELECT full_name, email, address FROM Customer WHERE customer_id = ?";
$stmt_user = $dbc->prepare($user_sql);
$stmt_user->bind_param("i", $customer_id);
$stmt_user->execute();
$user_data = $stmt_user->get_result()->fetch_assoc();

// 2. Obtener productos del carrito
$cart_sql = "SELECT p.product_name, p.product_price, sc.quantity 
             FROM ShoppingCart sc 
             JOIN Product p ON sc.product_id = p.product_id 
             WHERE sc.customer_id = ?";
$stmt_cart = $dbc->prepare($cart_sql);
$stmt_cart->bind_param("i", $customer_id);
$stmt_cart->execute();
$cart_result = $stmt_cart->get_result();

// --- VALIDACIÓN DE CARRITO VACÍO ---
if ($cart_result->num_rows == 0) {
    echo "
    <div class='container mt-5 mb-5 text-center'>
        <div class='card p-5 shadow-lg border-danger' style='background-color: #f8d7da; color: #721c24;'>
            <i class='bi bi-cart-x' style='font-size: 5rem;'></i>
            <h1 class='mt-4'>Your cart is empty!</h1>
            <p class='lead'>You need to add at least one item to your cart to proceed with the checkout.</p>
            <div class='mt-4'>
                <a href='index.php' class='btn btn-danger btn-lg'>
                    <i class='bi bi-shop'></i> Go to Shop
                </a>
            </div>
        </div>
    </div>";
    include('footer.php');
    exit(); // Detenemos la ejecución aquí para que no se muestre el formulario
}
// --- FIN DE VALIDACIÓN ---
?>

<style>
    body { background-color: #0d1b2a; color: white; } 
    .checkout-container { font-size: 1.2rem; } 
    .card { border-radius: 12px; }
    .user-info-box { background-color: #e9ecef; color: #333; border-radius: 8px; padding: 15px; font-size: 1rem; }
    .list-group-item { font-size: 1.15rem; border-color: #dee2e6; }
    .grand-total { font-size: 1.5rem; color: #0d6efd; }
</style>

<div class="container checkout-container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 px-4">
            <h2 class="mb-4 text-info"><i class="bi bi-cart-check"></i> Order Summary</h2>
            <div class="card shadow text-dark overflow-hidden">
                <ul class="list-group list-group-flush">
                    <?php 
                    $subtotal_general = 0;
                    while($item = $cart_result->fetch_assoc()): 
                        $item_total = $item['product_price'] * $item['quantity'];
                        $subtotal_general += $item_total;
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <strong><?php echo $item['product_name']; ?></strong>
                            <div class="text-muted small">Qty: <?php echo $item['quantity']; ?></div>
                        </div>
                        <span>$<?php echo number_format($item_total, 2); ?></span>
                    </li>
                    <?php endwhile; 
                    
                    $tax = $subtotal_general * 0.15;
                    $shipping = $subtotal_general * 0.10;
                    $grand_total = $subtotal_general + $tax + $shipping;
                    ?>
                    
                    <li class="list-group-item d-flex justify-content-between py-2">
                        <span>Subtotal</span>
                        <span>$<?php echo number_format($subtotal_general, 2); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-2 text-danger">
                        <span>Tax (15%)</span>
                        <span>$<?php echo number_format($tax, 2); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-2 text-primary">
                        <span>Shipping Cost (10%)</span>
                        <span>$<?php echo number_format($shipping, 2); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between py-3 bg-light grand-total">
                        <strong>Total Amount</strong>
                        <strong>$<?php echo number_format($grand_total, 2); ?></strong>
                    </li>
                </ul>
            </div>
            
            <div class="mt-4">
                <a href="view_cart.php" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-arrow-left"></i> Return to Cart
                </a>
            </div>
        </div>

        <div class="col-md-6 px-4">
            <h2 class="mb-4 text-info"><i class="bi bi-truck"></i> Shipping Details</h2>
            <div class="card p-4 shadow text-dark">
                
                <div class="user-info-box mb-4">
                    <h6 class="text-uppercase fw-bold text-muted border-bottom pb-2 mb-3">Customer Profile</h6>
                    <p class="mb-1"><strong>Full Name:</strong> <?php echo $user_data['full_name']; ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?php echo $user_data['email']; ?></p>
                    <p class="mb-0"><strong>Default Address:</strong> <?php echo $user_data['address']; ?></p>
                </div>

                <form action="process_order.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Shipping Address</label>
                        <textarea name="address" class="form-control form-control-lg" rows="2" required><?php echo $user_data['address']; ?></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Phone Number</label>
                        <input type="text" name="phone" class="form-control form-control-lg" placeholder="e.g. +1 123 456 789" required>
                    </div>

                    <div class="alert alert-secondary py-2 mb-4">
                        <i class="bi bi-person"></i> Ordering as: <strong><?php echo $_SESSION['username']; ?></strong>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold shadow">
                        COMPLETE PURCHASE <i class="bi bi-credit-card ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>