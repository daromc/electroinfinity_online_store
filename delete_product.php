<?php
include('connection.php');
include('check_admin.php'); // Seguridad ante todo
include('header.php');

// Obtener todos los productos
$sql = "SELECT p.product_id, p.product_name, p.product_price, p.product_quantity, p.product_image 
        FROM Product p 
        ORDER BY p.product_id DESC";
$result = mysqli_query($dbc, $sql);
?>

<div class="container mt-5 mb-5">
    <div class="card shadow">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Inventory Management - Delete Products</h4>
            <a href="add_product.php" class="btn btn-light btn-sm">Add New Product</a>
        </div>
        <div class="card-body">
            
            <?php if(isset($_GET['msg'])): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Images</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <img src="<?php echo $row['product_image']; ?>" 
                                    alt="img" 
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            </td>
                            <td><strong><?php echo $row['product_name']; ?></strong><br><small class="text-muted">ID: #<?php echo $row['product_id']; ?></small></td>
                            <td>$<?php echo number_format($row['product_price'], 2); ?></td>
                            <td><?php echo $row['product_quantity']; ?></td>
                            <td class="text-center">
                                <a href="delete_product_action.php?id=<?php echo $row['product_id']; ?>" 
                                   class="btn btn-outline-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.');">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
