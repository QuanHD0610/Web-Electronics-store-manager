<?php
// Define the number of products per page
$products_per_page = 8;

// Get the current page number from the URL parameter
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $products_per_page;

// Initialize an empty array to store products
$ds_dien_may = [];

// Create a new PDO instance and set the character encoding
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->query("set names 'utf8'");

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Initialize the base query
    $sql_ds_dien_may = "SELECT * FROM product";
    $sql_count = "SELECT COUNT(*) FROM product";

    // Check for sort parameter and modify the query accordingly
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'tang') {
            $sql_ds_dien_may .= " ORDER BY price ASC";
        } elseif ($sort == 'DESC') {
            $sql_ds_dien_may .= " ORDER BY price DESC";
        }
    }

    // Check for search query parameter and modify the query accordingly
    if (isset($_GET['search_query'])) {
        $search_query = $_GET['search_query'];
        $sql_ds_dien_may .= " WHERE product_name LIKE :search_query";
        $sql_count .= " WHERE product_name LIKE :search_query";
    }

    // Check for category name parameter and modify the query accordingly
    if (isset($_GET['category_name'])) {
        $category_name = $_GET['category_name'];
        $sql_ds_dien_may = "SELECT * FROM category c, product p WHERE c.category_id = p.category_id AND c.category_name = :category_name";
        $sql_count = "SELECT COUNT(*) FROM category c, product p WHERE c.category_id = p.category_id AND c.category_name = :category_name";
    }

    // Add pagination to the query
    $sql_ds_dien_may .= " LIMIT :offset, :products_per_page";

    // Prepare the queries
    $stmt = $pdo->prepare($sql_ds_dien_may);
    $stmt_count = $pdo->prepare($sql_count);

    // Bind parameters for search query
    if (isset($_GET['search_query'])) {
        $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        $stmt_count->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
    }

    // Bind parameters for category name
    if (isset($_GET['category_name'])) {
        $stmt->bindValue(':category_name', $category_name, PDO::PARAM_STR);
        $stmt_count->bindValue(':category_name', $category_name, PDO::PARAM_STR);
    }

    // Bind pagination parameters
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':products_per_page', $products_per_page, PDO::PARAM_INT);

    // Execute the queries
    $stmt->execute();
    $stmt_count->execute();

    // Fetch results and store in an array
    $ds_dien_may = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch the total number of products
    $total_products = $stmt_count->fetchColumn();
}

// Calculate the total number of pages
$total_pages = ceil($total_products / $products_per_page);

// Close the connection
$pdo = null;
?>
