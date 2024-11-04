<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php
include('header_admin.php');
include('check_admin.php');
?>

<div class="container col-md-6 mt-5">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Add New Products</h5>
    <!-- <p class="card-text">...</p> -->
  </div>
  <form action="add_product_verify.php" method="POST" enctype="multipart/form-data">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
      <label for="productName" class="form-label mt-3">Product Name:</label>
      <input type="text" name="newproduct" class="form-control mb-3" id="productName" aria-describedby="emailHelp">
    </li>
    <li class="list-group-item">
      <label for="description" class="form-label mt-3">Description:</label>
      <input type="text" name="des" class="form-control mb-3" id="description" aria-describedby="emailHelp">
    </li>
    <li class="list-group-item">
      <p class="mt-3">Upload Image:</p>
      <!-- <label class="input-group-text" for="inputGroupFile01">Upload Image:</label> -->
      <input type="file" name="img" class="form-control mb-3" id="inputGroupFile01">
    </li>
    <li class="list-group-item">
      <label for="price" class="form-label mt-3">Price:</label>
      <input type="text" name="newprice" class="form-control mb-3" id="price" aria-describedby="emailHelp">
    </li>
    <li class="list-group-item">
      <label for="quantity" class="form-label mt-3">Quantity:</label>
      <input type="text" name="newquantity" class="form-control mb-3" id="quantity" aria-describedby="emailHelp">
    </li>
    <li class="list-group-item">
      <select id="category_Select" name="newCategory" class="form-select" aria-label="Default select example">
        <option value="Category">Category</option>
        <option value="1">Computers</option>
        <option value="2">Cameras</option>
        <option value="3">Cellphones</option>
        <option value="4">Accesories</option>
      </select>
    </li>
  </ul>
  <div class="card-body">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <input type="hidden" name="MAX_FILE_SIZE" value="100000"><BR><BR>
      <button class="btn btn-outline-danger me-md-2" type="submit">Cancel</button>
      <button class="btn btn-outline-success" type="submit" value="SUBMIT">Update</button>
    </div>
  </div>
  </form>
 </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
