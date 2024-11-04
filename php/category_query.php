<select id="category_Select" class="form-select" aria-label="Default select example">
    <option value="All">All</option>
        <?php
                        
            $sql_category = "SELECT category_name FROM Category";
            $result_category = mysqli_query($dbc, $sql_category);
            // checking problems with the query
            if (!$result_category) {
                die('Error in query: ' . mysqli_error($dbc));
            }
            // Check if there are more than 1 rows in the variable $result_category
            if (mysqli_num_rows($result_category) > 0) {
                // Loop through each category_names
                while($row = mysqli_fetch_assoc($result_category)) {
                    // Output an <option> element for each category
                    echo "<option value='" . $row["category_name"] . "'>" . $row["category_name"] . "</option>";
                }
            }
        ?>
</select>