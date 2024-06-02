<?php
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ds_dien_may = [];

// Lấy danh sách sản phẩm và thêm các sản phẩm vào từng danh mục tương ứng
$sql_loai = "SELECT product.*, category.category_name as name_cate, brand.brand_name as name_brand
FROM product 
INNER JOIN category ON product.category_id = category.category_id 
INNER JOIN brand ON product.brand_id = brand.brand_id";

$params = [];
$conditions = [];

if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    $conditions[] = "product.product_name LIKE :search_query";
    $params[':search_query'] = "%$search_query%";
}

if (isset($_GET['filter'])) {
    $brand_id = $_GET['brand'];
    $category_id = $_GET['category'];

    if ($brand_id != "") {
        $conditions[] = "product.brand_id = :brand_id";
        $params[':brand_id'] = $brand_id;
    }

    if ($category_id != "") {
        $conditions[] = "product.category_id = :category_id";
        $params[':category_id'] = $category_id;
    }
}

if (!empty($conditions)) {
    $sql_loai .= " WHERE " . implode(' AND ', $conditions);
}

$stmt = $pdo->prepare($sql_loai);

foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

$stmt->execute();
$ds_dien_may = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy danh sách thương hiệu
$sql_brands = "SELECT * FROM brand";
$stmt_brands = $pdo->query($sql_brands);
$brands = $stmt_brands->fetchAll(PDO::FETCH_ASSOC);

// Lấy danh sách loại sản phẩm
$sql_categories = "SELECT * FROM category";
$stmt_categories = $pdo->query($sql_categories);
$categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .main-content {
            min-height: calc(100vh - 56px);
            padding-top: 56px;
        }

        .sidebar {
            height: calc(100vh - 56px);
            overflow-y: auto;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            bottom: 0;
            width: 100%;
        }

        .sidebar.fixed-left {
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
        }

        .fixed-left {
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
            padding-top: 15px;
        }

        .main-content {
            padding-left: 100px;
        }
    </style>
    <script>
        function confirmDelete(productId) {
            if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
                window.location.href = 'delete_product.php?id=' + productId;
            }
        }
    </script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="customer_info.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid main-content">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-2 col-lg-2 d-md-block bg-dark sidebar fixed-left">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order_view.php">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="brand_view.php">Brand</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Category_view.php">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customer_view.php">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Integrations</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="col-md-10 col-lg-10">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col">
                            <a href="Admin/Product/addProduct.php" class="btn btn-primary">Thêm sản phẩm</a>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search_query" class="form-control"
                                        placeholder="Tìm kiếm...">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="GET" class="mb-3">
                                <div class="input-group">
                                    <select name="brand" class="form-select" aria-label="Chọn thương hiệu">
                                        <option value="">Chọn thương hiệu...</option>
                                        <?php foreach ($brands as $brand) { ?>
                                            <option value="<?php echo $brand['brand_id']; ?>">
                                                <?php echo $brand['brand_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <select name="category" class="form-select" aria-label="Chọn loại sản phẩm">
                                        <option value="">Chọn loại sản phẩm...</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?php echo $category['category_id']; ?>">
                                                <?php echo $category['category_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" name="filter" value="true"
                                        class="btn btn-primary">Lọc</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-striped">
                    <thead class="text-center" style="background-color: #007bff; color: #fff;">
                        <tr>
                            <th>#</th>
                            <th>Img</th>
                            <th>Tên sản phẩm</th>
                            <th>Thương hiệu</th>
                            <th>Loại sản phẩm</th>
                            <th>Giá</th>
                            <th>Giá KM</th>
                            <th>Khuyến mãi</th>
                            <th>Tồn kho</th>
                            <th>Hành động</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($ds_dien_may)) { ?>
                            <tr>
                                <td colspan="10" class="text-center">Không có sản phẩm nào phù hợp.</td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($ds_dien_may as $index => $item) { ?>
                                <tr <?php echo ($index % 2 == 0) ? 'class="bg-light"' : ''; ?>>
                                    <td class="text-center"><?php echo $item['product_id'] ?></td>
                                    <td><img src="../Images/<?php echo $item['img'] ?>" alt="" width="100px" height="100px"></td>
                                    <td class="text-left"><?php echo $item['product_name'] ?></td>
                                    <td class="text-center"><?php echo $item['name_brand'] ?></td>
                                    <td class="text-center"><?php echo $item['name_cate'] ?></td>
                                    <td><?php echo number_format($item['price'], 0, '.', ',') ?> VNĐ</td>
                                    <td><?php echo number_format($item['price_km'], 0, '.', ',') ?> VNĐ</td>
                                    <td class="text-center"><?php echo $item['Km'] ?></td>
                                    <td class="text-center"><?php echo $item['stock_quantity'] ?></td>
                                    <td class="text-center">
                                        <a href="updateProduct.php?id=<?php echo $item['product_id']; ?>"
                                            class="btn btn-warning btn-sm">Update</a>
                                    </td>
                                    <td>
                                        <a href="deleteProduct.php?product_id=<?php echo $item['product_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            &copy; 2024 Admin Dashboard. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>