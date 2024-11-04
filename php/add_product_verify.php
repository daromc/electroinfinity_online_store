<?php
session_start();

//include ('header_admin.php'):
include ('connection.php');

// ---- Check connection status ---------------------------------------------------------------------------------------
if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}
// --------------------------------------------------------------------------------------------------------------------

// ---- Get information from the input form and store it in a variable ------------------------------------------------
$productName = mysqli_real_escape_string($dbc, $_POST['newproduct']);
$productDescription = mysqli_real_escape_string($dbc, $_POST['des']);
$productPrice = mysqli_real_escape_string($dbc, $_POST['newprice']);
$productQuantity = mysqli_real_escape_string($dbc, $_POST['newquantity']);
$productCategory = mysqli_real_escape_string($dbc, $_POST['newCategory']);

// ---------- File Upload process --------------------------------------------------------------------------------------
$path = '../images/'; // File Path

if (!empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name'])) {
    
    // Get original file name
    $originalName = basename($_FILES['img']['name']);
    $targetFilePath = $path . $originalName;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
        echo 'The uploaded file has been saved.';
        $productImage = $targetFilePath;
        ?>
        <script>
            alert("The uploaded file has been saved.");
        </script> <?php
    } else {
        echo 'Failed to save uploaded file. Error code: ' . $_FILES['img']['error'];
    }
} else {
    echo 'File not uploaded or not posted correctly.';
}

// ---------- File Upload process End ---------------------------------------------------------------------------------

// MySQL Query Statement for adding New Product using Prepared Statements
$stmt = $dbc->prepare("INSERT INTO Product (product_name, product_description, product_image, product_price, product_quantity) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssd", $productName, $productDescription, $productImage, $productPrice, $productQuantity);

if ($stmt->execute()) {
    $NewNumber = $stmt->insert_id; // Get the auto-incremented ID of the new product
    $stmt->close();

    // MySQL Query Statement for adding Category using Prepared Statements
    $stmt_category = $dbc->prepare("INSERT INTO categoryProduct (Category_id, Product_id) VALUES (?, ?)");
    $stmt_category->bind_param("ii", $productCategory, $NewNumber);

    if ($stmt_category->execute()) {
        echo "<p>Insert successful</p>";
        echo "<p>Go back to <a href='login.php'>Home</a></p>";
    } else {
        echo "<h3>SQL Error ==> " . $stmt_category->error . "<br></h3>";
        echo "<p>Error: " . mysqli_error($dbc) . "</p>";
    }
    $stmt_category->close();
} else {
    echo "<h3>SQL Error ==> " . $stmt->error . "<br></h3>";
    echo "<p>Error: " . mysqli_error($dbc) . "</p>";
}
?>

