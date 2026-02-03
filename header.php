
<!-- Header File -->


<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Detectamos el tipo de usuario
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
$isLoggedIn = isset($_SESSION['customer_id']) || isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroInfinity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel='stylesheet'>
    <style>
        @font-face {
            font-family: 'Algerian';
            src: url('https://fonts.cdnfonts.com/s/61982/Algerian.woff') format('woff');
        }
        /* Cambiamos el color de la navbar si es admin para evitar confusiones */
        .navbar-admin { background-color: #1a1a1a !important; border-bottom: 2px solid #0dcaf0; }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg <?php echo $isAdmin ? 'navbar-admin bg-dark' : 'bg-light'; ?>">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../images/logo2.png" alt="Logo" class="logo">
                    <span class="website-title">ELECTROINFINITY</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $isAdmin ? 'text-info' : ''; ?>" href="index.php">Home</a>
                        </li>

                        <?php if ($isAdmin): ?>
                            <li class="nav-item"><a class="nav-link text-info" href="add_product.php">Add products</a></li>
                            <li class="nav-item"><a class="nav-link text-info" href="delete_product.php">Delete products</a></li>
                            <li class="nav-item"><a class="nav-link text-info" href="add_category.php">Add categories</a></li>
                            <li class="nav-item"><a class="nav-link text-info" href="view_orders_admin.php">View Orders</a></li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="view_cart.php">
                                    <i class="fas fa-shopping-cart"></i> View Cart
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="check_out_verify.php">Check Out</a></li>
                            <li class="nav-item"><a class="nav-link" href="order_history.php">Order History</a></li>
                        <?php endif; ?>
                    </ul>

                    <div class="d-flex align-items-center">
                        <?php if ($isLoggedIn): ?>
                            <span class="me-3 <?php echo $isAdmin ? 'text-info' : 'text-dark'; ?>">
                                <i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?>
                            </span>
                            <form action='logout.php' method='post' class="m-0">
                                <button type="submit" class="btn btn-danger btn-sm">Log Out</button>
                            </form>
                        <?php else: ?>
                            <a href="user_login.php" class="btn btn-outline-primary btn-sm">Log In</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

