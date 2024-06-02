<?php
// Kết nối đến cơ sở dữ liệu
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Xử lý thông tin tìm kiếm từ form
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
$customer_name = isset($_GET['customer_name']) ? $_GET['customer_name'] : null;

// Nếu đã submit form
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($start_date) && isset($end_date)) {
    // Tạo câu truy vấn SQL để lấy các phiếu order trong khoảng thời gian đã chỉ định và có tên khách hàng nhất định (nếu có)
    $sql = "SELECT oc.order_id, oc.order_date, c.customer_name, oc.total_amount 
            FROM order_customer oc 
            LEFT JOIN customer c ON oc.customer_id = c.customer_id 
            WHERE oc.order_date BETWEEN :start_date AND :end_date";

    // Nếu có tên khách hàng được cung cấp, thêm điều kiện tìm kiếm vào câu truy vấn SQL
    if ($customer_name) {
        $sql .= " AND c.customer_name LIKE :customer_name";
    }

    $stmt = $pdo->prepare($sql);
    $params = ['start_date' => $start_date, 'end_date' => $end_date];

    // Nếu có tên khách hàng được cung cấp, thêm tham số cho câu truy vấn SQL
    if ($customer_name) {
        $params['customer_name'] = "%$customer_name%";
    }

    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        /* Custom styles */
        .main-content {
            min-height: calc(100vh - 56px);
            /* Subtract navbar height */
            padding-top: 56px;
            /* Same height as navbar */
        }

        .sidebar {
            height: calc(100vh - 56px);
            /* Subtract navbar height */
            overflow-y: auto;
            /* Enable scrollbar if content overflows */
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
            /* Height of navbar */
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
        }

        .main-content.fixed-left {
            padding-left: 200px;
            /* Width of sidebar */
        }

        /* CSS */
        .fixed-left {
            position: fixed;
            top: 56px;
            /* Chiều cao của navbar */
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
            padding-top: 15px;
            /* Điều chỉnh khoảng cách giữa đỉnh cửa sổ và sidebar */
        }

        .main-content {
            padding-left: 200px;
            /* Chiều rộng của sidebar */
        }

        @media (max-width: 768px) {

            /* Đảm bảo rằng sidebar sẽ không cố định ở trên các thiết bị di động */
            .fixed-left {
                position: relative;
                top: auto;
                bottom: auto;
                left: auto;
                z-index: auto;
                overflow-y: visible;
                padding-top: 0;
            }

            .main-content {
                padding-left: 0;
            }
        }
    </style>
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
                            <a class="nav-link" href="oder_view.php">Orders</a>
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
            <div class="col-md-10 col-lg-10" style="margin-left:100px">
                <h1>Danh sách phiếu order</h1>

                <form method="GET" action="order_view.php">
                    <label for="start_date">Từ ngày:</label>
                    <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">

                    <label for="end_date">Đến ngày:</label>
                    <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">

                    <label for="customer_name">Tên khách hàng:</label>
                    <input type="text" id="customer_name" name="customer_name" placeholder="Nhập tên cần tìm">

                    <button type="submit">Lọc</button>
                </form>

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID Order</th>
                            <th scope="col">Ngày Order</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($orders) && !empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?php echo $order['order_id']; ?></td>
                                    <td><?php echo $order['order_date']; ?></td>
                                    <td><?php echo $order['customer_name']; ?></td>
                                    <td><?php echo $order['total_amount']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
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