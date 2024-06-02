<?php
session_start();

// Check if the user is logged in and has the right to delete products
if (!isset($_SESSION['customer_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare and execute the SQL statement
        $sql = "DELETE FROM product WHERE product_id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        // Close the database connection
        $pdo = null;

        // Redirect back to the product management page
        header('Location: admin.php');
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
