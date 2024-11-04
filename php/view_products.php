<!-- Table Products-->
        <h2 style='text-align: center;'>Products</h2>
        <br>
        
        <div style='margin: auto; width: 80%;'>
            <table border='1' style='border-collapse: collapse; width: 100%;'>
            <div class="row row-cols-3">
                <?php 
                    // checking the value of $selected_category if is empty or if is "All" display all the products
                    //echo $selected_category;
                    //echo $_POST["selected_category"];
                    $selected_category = isset($_POST["selected_category"]) ? strtolower($_POST["selected_category"]) : "All";
                    //checkin the $selected_category variable, to use the query with a filter category
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && $selected_category != "All" && $selected_category != "") {
                        $selected_category;
                        $category_query = " SELECT p.*, c.category_name
                                            FROM Product p
                                            JOIN categoryProduct cp ON p.product_id = cp.product_id
                                            JOIN Category c ON cp.category_id = c.category_id
                                            WHERE c.category_name = '$selected_category';";

                        $result = mysqli_query($dbc, $category_query );

                    }
                    else {
                        // if not, let display all the products 
                        //here we create the query for all the products
                        $query = "SELECT * FROM Product";
                        //here we excecute the query 
                        $result = mysqli_query($dbc, $query);  
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="col mb-4">
                                <div class="card border-success" style="max-width: 18rem;">
                                    <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                        <p class="card-text"><?php echo $row['product_description']; ?></p>
                                        <p><span>Price: </span><span class="card-text">$<?php echo $row['product_price']; ?></span></p>
                                    </div>
                                    <div class="card-footer bg-transparent border-success">
                                        <button>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php }                 
                    // Close the connection with the database
                    mysqli_close($dbc);
                    ?>
                </div>
            </table> 
</div>
    <!-- End Table Products-->