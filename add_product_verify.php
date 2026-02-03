<?php
// 1. Mostrar errores para saber qué pasa
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include('connection.php');

// 2. Verificar sesión (Usando la lógica que ya te funciona en otros archivos)
if(!isset($_SESSION['customer_id'])) { 
    die("Error: No session found. Please login."); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = mysqli_real_escape_string($dbc, $_POST['newproduct']);
    $productDescription = mysqli_real_escape_string($dbc, $_POST['des']);
    $productPrice = $_POST['newprice'];
    $productQuantity = $_POST['newquantity'];
    $productCategory = $_POST['newCategory'];

    // --- Proceso de Imagen ---
    $uploadDirectory = "../images/";
    
    // Verificamos si realmente se subió un archivo
    if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
        die("Error en la subida del archivo. Código de error: " . $_FILES['img']['error']);
    }

    $imageName = basename($_FILES['img']['name']);
    $targetFilePath = $uploadDirectory . $imageName;
    $dbImagePath = "../images/" . $imageName; 

    // Intentar mover el archivo
    if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
        
        // 3. Insertar Producto (SIN ESPACIOS en "sssdi")
        // s = string, d = double (precio), i = integer (cantidad)
        $stmt = $dbc->prepare("INSERT INTO Product (product_name, product_description, product_image, product_price, product_quantity) VALUES (?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            die("Error en Prepare (Product): " . $dbc->error);
        }

        $stmt->bind_param("sssdi", $productName, $productDescription, $dbImagePath, $productPrice, $productQuantity);

        if ($stmt->execute()) {
            $newProductID = $stmt->insert_id;

            // 4. Relacionar con Categoría
            $stmt_cat = $dbc->prepare("INSERT INTO categoryProduct (category_id, product_id) VALUES (?, ?)");
            
            if (!$stmt_cat) {
                die("Error en Prepare (Category): " . $dbc->error);
            }

            $stmt_cat->bind_param("ii", $productCategory, $newProductID);
            
            if ($stmt_cat->execute()) {
                // ÉXITO TOTAL: Redirigir
                header("Location: add_product.php?status=success");
                exit();
            } else {
                echo "Error vinculando categoría: " . $stmt_cat->error;
            }
        } else {
            echo "Error insertando producto: " . $stmt->error;
        }
    } else {
        echo "Error: No se pudo mover el archivo a $targetFilePath. <br>";
        echo "Verifica que la carpeta 'images' tenga permisos de escritura: <b>sudo chmod 777 /opt/lampp/htdocs/electroinfinity/images</b>";
    }
} else {
    echo "No se recibió una solicitud POST.";
}
?>