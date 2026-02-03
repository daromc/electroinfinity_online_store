<?php
// Mueve esto al principio para que los headers de sesión funcionen
include('connection.php');
include('check_admin.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php include('header.php'); ?>

<div class="container col-md-6 mt-5 mb-5">
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Product added to the store.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white p-3">
            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Add New Product</h5>
        </div>
        
        <form action="add_product_verify.php" method="POST" enctype="multipart/form-data">
            <div class="card-body p-4">
                <div class="mb-3 text-dark">
                    <label class="form-label fw-bold">Product Name</label>
                    <input type="text" name="newproduct" class="form-control" placeholder="e.g. Sony Alpha A7" required>
                </div>
                
                <div class="mb-3 text-dark">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="des" class="form-control" rows="3" placeholder="Technical specifications..." required></textarea>
                </div>

                <div class="mb-3 text-dark">
                    <label class="form-label fw-bold">Upload Image</label>
                    <input type="file" name="img" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3 text-dark">
                        <label class="form-label fw-bold">Price ($)</label>
                        <input type="number" step="0.01" name="newprice" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="col-md-6 mb-3 text-dark">
                        <label class="form-label fw-bold">Stock Quantity</label>
                        <input type="number" name="newquantity" class="form-control" placeholder="10" required>
                    </div>
                </div>

                <div class="mb-3 text-dark">
                    <label class="form-label fw-bold">Category</label>
                    <select name="newCategory" class="form-select" required>
                        <option value="">Choose category...</option>
                        <?php
                        $cat_res = mysqli_query($dbc, "SELECT * FROM Category");
                        while($cat = mysqli_fetch_assoc($cat_res)) {
                            echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end gap-2 p-3">
                <a href="index.php" class="btn btn-light border">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Save Product</button>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>