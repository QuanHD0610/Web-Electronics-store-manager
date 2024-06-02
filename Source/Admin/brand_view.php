<?php
// Kết nối đến cơ sở dữ liệu
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $e->getMessage());
}

// Xử lý yêu cầu thêm thương hiệu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['brand_name'])) {
    $brand_name = $_POST['brand_name'];
    $sql = "INSERT INTO brand (brand_name) VALUES (:brand_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brand_name', $brand_name);
    if ($stmt->execute()) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        echo "Lỗi: " . $pdo->errorInfo()[2];
    }
}

// Xử lý yêu cầu xoá thương hiệu
if (isset($_GET['delete'])) {
    $brand_id = $_GET['delete'];
    $sql = "DELETE FROM brand WHERE brand_id=:brand_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brand_id', $brand_id);
    if ($stmt->execute()) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        echo "Lỗi: " . $pdo->errorInfo()[2];
    }
}

// Lấy thông tin thương hiệu cần chỉnh sửa
if (isset($_GET['edit'])) {
    $brand_id = $_GET['edit'];
    $sql = "SELECT * FROM brand WHERE brand_id=:brand_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brand_id', $brand_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $brand_name = $row['brand_name'];
    } else {
        echo "Không tìm thấy thương hiệu.";
    }
}

// Xử lý yêu cầu chỉnh sửa thương hiệu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_brand'])) {
    $brand_id = $_POST['brand_id'];
    $brand_name = $_POST['brand_name'];
    $sql = "UPDATE brands SET brand_name=:brand_name WHERE brand_id=:brand_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':brand_id', $brand_id);
    $stmt->bindParam(':brand_name', $brand_name);
    if ($stmt->execute()) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        echo "Lỗi: " . $pdo->errorInfo()[2];
    }
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
            padding-left: 100px;
        }
    </style>
    <script>
        function confirmDelete(brandId) {
            if (confirm("Bạn có chắc chắn muốn xóa thương hiệu này không?")) {
                window.location.href = 'brand_view.php?delete=' + brandId;
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
                    <a class="nav-link" href="../logout.php">Logout</a>
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
            <div class="container mt-3 " style="margin-left:200px">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Quản lý Thương hiệu</h1>

                        <!-- Form thêm thương hiệu -->
                        <h2>Thêm Thương hiệu</h2>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <label for="brand_name">Tên Thương hiệu:</label>
                            <input type="text" id="brand_name" name="brand_name" required>
                            <button type="submit">Thêm</button>
                        </form>

                        <!-- Danh sách thương hiệu hiện có -->
                        <!-- Danh sách thương hiệu hiện có -->
<h2 class="text-center">Danh sách Thương hiệu</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên Thương hiệu</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM brand";
        $stmt = $pdo->query($sql);
        $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($brands) > 0) {
            foreach ($brands as $key => $brand) {
                echo "<tr>";
                echo "<td>" . ($key + 1) . "</td>";
                echo "<td>{$brand['brand_name']}</td>";
                echo "<td>
                        <a href='brand_view.php?edit={$brand['brand_id']}' class='btn btn-primary btn-sm'>Sửa</a>
                        <button class='btn btn-danger btn-sm' onclick='confirmDelete({$brand['brand_id']})'>Xoá</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Không có thương hiệu nào.</td></tr>";
        }
        ?>
    </tbody>
</table>

                        <!-- Form chỉnh sửa thương hiệu -->
                        <?php if (isset($_GET['edit'])) { ?>
                            <h2>Chỉnh sửa Thương hiệu</h2>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>">
                                <label for="brand_name">Tên Thương hiệu:</label>
                                <input type="text" id="brand_name" name="brand_name"
                                       value="<?php echo $brand_name; ?>" required>
                                <button type="submit" name="edit_brand">Lưu</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
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
$pdo = null;
?>
