<h2 style='text-align: center;'>Products</h2>
<br>

<?php 
// 1. Capturar valores del POST que vienen de index.php
$selected_category = isset($_POST["selected_category"]) ? $_POST["selected_category"] : "All";
$sort_price = isset($_POST["sort_price"]) ? $_POST["sort_price"] : "none";

// 2. Base de la Query (Lógica de filtrado)
if ($_SERVER["REQUEST_METHOD"] == "POST" && strtolower($selected_category) !== "all" && $selected_category !== "") {
    $safe_category = mysqli_real_escape_string($dbc, $selected_category);
    $query = "SELECT p.* FROM Product p
              INNER JOIN categoryProduct cp ON p.product_id = cp.product_id
              INNER JOIN Category c ON cp.category_id = c.category_id
              WHERE c.category_name = '$safe_category'";
} else {
    $query = "SELECT * FROM Product";
}

// 3. Añadir el Ordenamiento (Se concatena a la query anterior)
if ($sort_price === "ASC") {
    $query .= " ORDER BY product_price ASC";
} elseif ($sort_price === "DESC") {
    $query .= " ORDER BY product_price DESC";
}

// 4. Ejecutar la Query final unificada
$result = mysqli_query($dbc, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($dbc));
}
?>

<div style='margin: auto; width: 80%;'>
    <div class="row row-cols-1 row-cols-md-3 g-4"> 
        <?php 
            // 5. Mostrar los resultados
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col">
                <div class="card h-100 border-success shadow-sm">
                    <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: contain; padding: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                        <p class="card-text text-truncate"><?php echo $row['product_description']; ?></p>
                        <p class="h5 text-success">$<?php echo number_format($row['product_price'], 2); ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-success d-grid">
                        <a href="cart_db_manage.php?action=add&pid=<?php echo $row['product_id']; ?>" 
                        class="btn btn-success">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        <?php 
                } 
            } else {
                echo "<div class='col-12 text-center'><p class='alert alert-info'>No products found with these filters.</p></div>";
            }
        ?>
    </div>
</div>