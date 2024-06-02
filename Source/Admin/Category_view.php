<?php
// Kết nối đến cơ sở dữ liệu
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $e->getMessage());
}

// Xử lý yêu cầu thêm danh mục
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_name'])) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO category (category_name) VALUES (:category_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category_name', $category_name);
    if ($stmt->execute()) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        echo "Lỗi: " . $stmt->errorInfo()[2];
    }
}

// Xử lý yêu cầu xoá danh mục
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];
    $sql = "DELETE FROM category WHERE category_id=:category_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category_id', $category_id);
    if ($stmt->execute()) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        echo "Lỗi: " . $stmt->errorInfo()[2];
    }
}

// Lấy thông tin danh mục cần chỉnh sửa
if (isset($_GET['edit'])) {
    $category_id = $_GET['edit'];
    $sql = "SELECT * FROM category WHERE category_id=:category_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $category_name = $row['category_name'];
    } else {
        echo "Không tìm thấy danh mục.";
    }
}

// Xử lý yêu cầu chỉnh sửa danh mục
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_category'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $sql = "UPDATE categories SET category_name=:category_name WHERE category_id=:category_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':category_name', $category_name);
    if ($stmt->execute()) {
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        echo "Lỗi: " . $stmt->errorInfo()[2];
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
        function confirmDelete(categoryId) {
            if (confirm("Bạn có chắc chắn muốn xóa danh mục này không?")) {
                window.location.href = 'category_view.php?delete=' + categoryId;
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
                            <a class="nav-link" href="category_view.php">Category</a>
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
                <div class="container mt-3" style="margin-left:200px">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-center">Quản lý Danh mục</h1>

                            <!-- Form thêm danh mục -->
                            <h2>Thêm Danh mục</h2>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <label for="category_name">Tên Danh mục:</label>
                                <input type="text" id="category_name" name="category_name" required>
                                <button type="submit">Thêm</button>
                            </form>

                            <!-- Danh sách danh mục hiện có -->
                            <h2 class="text-center">Danh sách Danh mục</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên Danh mục</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM category";
                                    $stmt = $pdo->query($sql);
                                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    if (count($categories) > 0) {
                                        foreach ($categories as $key => $category) {
                                            echo "<tr>";
                                            echo "<td>" . ($key + 1) . "</td>";
                                            echo "<td>{$category['category_name']}</td>";
                                            echo "<td>
                        <a href='?edit={$category['category_id']}' class='btn btn-primary btn-sm'>Sửa</a>
                        <a href='?delete={$category['category_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xoá?\")'>Xoá</a>
                      </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>Không có danh mục nào.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- Form chỉnh sửa danh mục -->
                            <?php if (isset($_GET['edit'])) { ?>
                                <h2>Chỉnh sửa Danh mục</h2>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                    <label for="category_name">Tên Danh mục:</label>
                                    <input type="text" id="category_name" name="category_name"
                                        value="<?php echo $category_name; ?>" required>
                                    <button type="submit" name="edit_category">Lưu</button>
                                </form>
                            <?php } ?>
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