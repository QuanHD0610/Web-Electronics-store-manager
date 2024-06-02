<?php
session_start();

// Kiểm tra người dùng có phải là admin không
// if (!isset($_SESSION['customer_id']) || $_SESSION['customer_name'] != 'admin') {
//     die("Bạn không có quyền truy cập trang này.");
// }

// Khai báo biến để lưu thông báo lỗi hoặc thành công
$mess = "";

// Kết nối đến cơ sở dữ liệu
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy danh sách thương hiệu và danh mục
    $brands = $pdo->query("SELECT brand_id, brand_name FROM brand")->fetchAll(PDO::FETCH_ASSOC);
    $categories = $pdo->query("SELECT category_id, category_name FROM category")->fetchAll(PDO::FETCH_ASSOC);

    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kiểm tra và lấy dữ liệu từ biểu mẫu
        $product_name = $_POST['product_name'] ?? '';
        $brand_id = $_POST['brand_id'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $price = $_POST['price'] ?? null;
        $km = $_POST['km'] ?? null;
        $stock_quantity = $_POST['stock_quantity'] ?? null;
        $description = $_POST['description'] ?? '';
        $specification = $_POST['specification'] ?? '';

        // Xử lý upload ảnh
        if (isset($_FILES['img'])) {
            $img_name = $_FILES['img']['name'];
            $img_tmp_name = $_FILES['img']['tmp_name'];
            $img_size = $_FILES['img']['size'];
            $img_error = $_FILES['img']['error'];

            // Kiểm tra xem có lỗi khi upload không
            if ($img_error === 0) {
                // Di chuyển tệp đã tải lên vào thư mục lưu trữ
                $img_destination = 'Images/' . $img_name;
                move_uploaded_file($img_tmp_name, $img_destination);

                // Lưu tên tệp vào cơ sở dữ liệu hoặc thực hiện các thao tác khác
                $img = $img_destination;
            } else {
                // Xử lý lỗi khi upload ảnh
                $mess = '<p class="text-danger">Đã xảy ra lỗi khi tải lên ảnh.</p>';
            }
        } else {
            // Xử lý khi không có ảnh được tải lên
            $mess = '<p class="text-danger">Vui lòng chọn ảnh để tải lên.</p>';
        }

        // Tiếp tục xử lý thông tin sản phẩm và thêm vào cơ sở dữ liệu
    }
} catch (PDOException $e) {
    // Đặt thông báo lỗi
    $mess = '<p class="text-danger">Lỗi khi kết nối cơ sở dữ liệu: ' . $e->getMessage() . '</p>';
}
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
            padding-left: 250px;
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
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
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
                            <a class="nav-link" href="#">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Customers</a>
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
                <div class="container mt-5">
                    <h2>Thêm sản phẩm mới</h2>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <button style="margin-left:800px" type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Thương hiệu</label>
                            <select class="form-control" id="brand_id" name="brand_id" required>
                                <option value="">Chọn thương hiệu</option>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh mục</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Chọn danh mục</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['category_id']; ?>">
                                        <?php echo $category['category_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="km" class="form-label">Khuyến Mãi (%)</label>
                            <input type="number" class="form-control" id="km" name="km" required>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Số lượng tồn kho</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="specification" class="form-label">Thông số kỹ thuật</label>
                            <textarea class="form-control" id="specification" name="specification" rows="3"
                                required></textarea>
                        </div>
                    </form>
                    <?php echo $mess; ?>
                </div>
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
<?php
// Đóng kết nối
$conn->close();
?>