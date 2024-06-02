<?php
// Kết nối đến cơ sở dữ liệu
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM product WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_name = $_POST['product_name'];
        $brand_id = $_POST['brand_id'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $price_km = $_POST['price_km'];
        $km = $_POST['km'];
        $stock_quantity = $_POST['stock_quantity'];
        $img = $_FILES['img']['name'];

        // Nếu có ảnh mới được tải lên
        if (!empty($img)) {
            $target_dir = "Images/";
            $target_file = $target_dir . basename($img);
            if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                // Ảnh được tải lên thành công
            } else {
                echo "Xảy ra lỗi khi tải lên ảnh.";
            }
        } else {
            $img = $product['img'];
        }

        // Cập nhật sản phẩm
        $sql_update = "UPDATE product 
                       SET product_name = :product_name, brand_id = :brand_id, category_id = :category_id, 
                           price = :price, price_km = :price_km, Km = :km, stock_quantity = :stock_quantity, img = :img 
                       WHERE product_id = :product_id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->bindParam(':product_name', $product_name);
        $stmt_update->bindParam(':brand_id', $brand_id);
        $stmt_update->bindParam(':category_id', $category_id);
        $stmt_update->bindParam(':price', $price);
        $stmt_update->bindParam(':price_km', $price_km);
        $stmt_update->bindParam(':km', $km);
        $stmt_update->bindParam(':stock_quantity', $stock_quantity);
        $stmt_update->bindParam(':img', $img);
        $stmt_update->bindParam(':product_id', $product_id);

        if ($stmt_update->execute()) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Xảy ra lỗi khi cập nhật sản phẩm.";
        }
    }

    // Lấy danh sách thương hiệu
    $sql_brands = "SELECT * FROM brand";
    $stmt_brands = $pdo->query($sql_brands);
    $brands = $stmt_brands->fetchAll(PDO::FETCH_ASSOC);

    // Lấy danh sách loại sản phẩm
    $sql_categories = "SELECT * FROM category";
    $stmt_categories = $pdo->query($sql_categories);
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Update Product</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="brand_id" class="form-label">Thương hiệu</label>
                <select class="form-control" id="brand_id" name="brand_id" required>
                    <?php foreach ($brands as $brand) { ?>
                        <option value="<?php echo $brand['brand_id']; ?>" <?php echo $brand['brand_id'] == $product['brand_id'] ? 'selected' : ''; ?>>
                            <?php echo $brand['brand_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Loại sản phẩm</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['category_id']; ?>" <?php echo $category['category_id'] == $product['category_id'] ? 'selected' : ''; ?>>
                            <?php echo $category['category_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price"
                    value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="price_km" class="form-label">Giá khuyến mãi</label>
                <input type="number" class="form-control" id="price_km" name="price_km"
                    value="<?php echo htmlspecialchars($product['price_km']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="km" class="form-label">Khuyến mãi</label>
                <input type="text" class="form-control" id="km" name="km"
                    value="<?php echo htmlspecialchars($product['Km']); ?>">
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Tồn kho</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                    value="<?php echo htmlspecialchars($product['stock_quantity']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="img" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>

</html>