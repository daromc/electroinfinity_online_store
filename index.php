<?php 
session_start(); 
include('header.php'); 
?>
<body>
    <?php include('connection.php'); ?>
    
    <div class="container mt-4">
        <form id="filter_form" method="post" action="index.php" class="bg-light p-3 rounded border">
            <div class="row align-items-end">
                <div class="col-sm-4"> 
                    <label class="form-label fw-bold">Select Category:</label>
                    <?php include('category_query.php'); ?>
                </div>

                <div class="col-sm-4">
                    <label class="form-label fw-bold">Sort by Price:</label>
                    <select name="sort_price" class="form-select" onchange="this.form.submit()">
                        <option value="none" <?php if(!isset($_POST['sort_price']) || $_POST['sort_price'] == 'none') echo 'selected'; ?>>Default</option>
                        <option value="ASC" <?php if(isset($_POST['sort_price']) && $_POST['sort_price'] == 'ASC') echo 'selected'; ?>>Lowest to Highest</option>
                        <option value="DESC" <?php if(isset($_POST['sort_price']) && $_POST['sort_price'] == 'DESC') echo 'selected'; ?>>Highest to Lowest</option>
                    </select>
                </div>

                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
            </div>
        </form>

        <br>
        <p><b>Results for: </b>
            <span class="badge bg-primary">
            <?php 
                $selected_category_ = isset($_POST["selected_category"]) ? $_POST["selected_category"] : "All";
                echo htmlspecialchars($selected_category_);
            ?>
            </span>
        </p>
        <hr>
    </div>

    <div class="container">
        <?php include('view_products.php'); ?>
    </div>

</body>
<?php include('footer.php'); ?>