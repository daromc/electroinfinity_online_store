<?php
include('connection.php');
include('check_admin.php'); 
include('header.php');
?>

<div class="container col-md-5 mt-5 mb-5">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> New category added successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white p-3">
            <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Create New Category</h5>
        </div>
        
        <form action="add_category_verify.php" method="POST">
            <div class="card-body p-4 text-dark">
                <div class="mb-3">
                    <label class="form-label fw-bold">Category Name</label>
                    <input type="text" name="cat_name" class="form-control form-control-lg" placeholder="e.g., Gaming Consoles" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="cat_des" class="form-control" rows="4" placeholder="Briefly describe what kind of products fit here..." required></textarea>
                </div>
            </div>
            
            <div class="card-footer bg-white d-flex justify-content-end gap-2 p-3">
                <a href="index.php" class="btn btn-light border">Cancel</a>
                <button type="submit" class="btn btn-primary px-4 fw-bold">Save Category</button>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>
