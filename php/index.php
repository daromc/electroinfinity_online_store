
<?php include('header.php'); ?>
<body>
        <?php 
            include('connection.php'); 
        ?>
        <div class="container">
            <!-- 1. filter -->
            <br>
            <p>Please select the category: </p>
            <div class="row">
                <div class="col-sm-2"> 
                    <?php 
                    
                    include('category_query.php');
                    ?>

                </div>
            <!-- end filter -->
            <!-- 2. select button-->
                <div class="col-sm-10"> 
                    <!-- Form with hidden input -->
                    <form id="category_form" method="post" action="index.php">
                        <input type="hidden" id="selected_category_input" name="selected_category">
                        <button type="submit" class="btn btn-success">Search</button>
                    </form>
                </div>
            <!-- end select button-->
            </div>
            <br>
            <br>
            <p><b>Category: </b>
                <span id="selected_Category">
                <?php 
                    $selected_category_ = isset($_POST["selected_category"]) ? strtolower($_POST["selected_category"]) : "All";
                    echo $selected_category_ ;
                ?>
                </span>
            </p>
            <br>
        </div>
        <script>
            // Get the category
            var selectElement = document.getElementById('category_Select');
            // Get the span
            var selectedCategoryElement = document.getElementById('selected_Category');
            // Get the hidden input field
            var selectedCategoryInput = document.getElementById('selected_category_input');
            // Add event listener for change event
            selectElement.addEventListener('change', function() {
                selectedCategoryElement.textContent = selectElement.value;
                  // Update the value of hidden input field
                selectedCategoryInput.value = selectElement.value;
            });
        
        </script>
        <?php include('view_products.php'); ?>
        
</body>
<?php include('footer.php'); ?>


