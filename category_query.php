<?php
// category_query.php
$query_cat = "SELECT * FROM Category";
$result_cat = mysqli_query($dbc, $query_cat);

// EL ATRIBUTO NAME ES VITAL
echo '<select name="selected_category" class="form-select" onchange="this.form.submit()">';
echo '<option value="All">All Categories</option>';

while ($row_cat = mysqli_fetch_assoc($result_cat)) {
    // Verificamos si esta es la categoría seleccionada para mantenerla marcada
    $selected = (isset($_POST['selected_category']) && $_POST['selected_category'] == $row_cat['category_name']) ? 'selected' : '';
    
    echo '<option value="' . $row_cat['category_name'] . '" ' . $selected . '>' . $row_cat['category_name'] . '</option>';
}
echo '</select>';
?>