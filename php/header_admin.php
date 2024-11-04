 <!-- Admin Header File -->
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroInfinity</title>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
	  <link href="../css/styles.css" rel='stylesheet'>

    <style>
        @font-face {
            font-family: 'Algerian';
            src: url('https://fonts.cdnfonts.com/s/61982/Algerian.woff') format('woff');
        }
    </style>


</head>
    <body>
        <!-- Nav Ber -->
        <nav class="navbar navbar-expand-lg bg-dark">
            <a class="navbar-brand" href="index.php">
                <img src="../images/logo2.png" alt="Electroinfinity Store" class="logo">
                <span class="website-title">ELECTROINFINITY</span>
            </a>
            <button class="navbar-toggler btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon btn btn-info"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active text-info" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="add_product.php">Add products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">Delete products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">Privacy Settings</a>
                </li>
                <li>
                  <form action='logout.php' method='post' class="d-flex justify-content-end ps-5">
                    <button type="submit" value="SUBMIT" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger">Log Out</button>
                  </form>
                </li>

                </ul>
            </div>
            </div>
        </nav>

        </header>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
