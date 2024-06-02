<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    die("Bạn cần đăng nhập để xem chi tiết hóa đơn.");
}

if (!isset($_SESSION['order_id'])) {
    die("Mã hóa đơn không hợp lệ.");
}

$order_id = $_SESSION['order_id'];
$customer_id = $_SESSION['customer_id'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn thông tin hóa đơn
    $sql_order = "SELECT * FROM order_customer WHERE order_id = :order_id AND customer_id = :customer_id";
    $stmt_order = $pdo->prepare($sql_order);
    $stmt_order->execute([':order_id' => $order_id, ':customer_id' => $customer_id]);
    $order = $stmt_order->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        die("Hóa đơn không tồn tại hoặc bạn không có quyền xem hóa đơn này.");
    }

    // Truy vấn chi tiết hóa đơn cùng với tên sản phẩm từ bảng sản phẩm
    $sql_order_details = "SELECT od.*, p.product_name FROM order_detail od 
                          JOIN product p ON od.product_id = p.product_id 
                          WHERE od.order_id = :order_id";
    $stmt_order_details = $pdo->prepare($sql_order_details);
    $stmt_order_details->execute([':order_id' => $order_id]);
    $order_details = $stmt_order_details->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết hóa đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/style.css">
</head>
<body>
    <?php include 'Lib/header.php'; ?>

    <div class="container mt-5">
        <h2>Chi tiết hóa đơn #<?php echo htmlspecialchars($order['order_id']); ?></h2>
        <p><strong>Ngày đặt:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
        <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>đ</p>
        <p><strong>Phương thức thanh toán:</strong> <?php echo htmlspecialchars($order['payment']); ?></p>

        <h3>Sản phẩm</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $detail): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        <td><?php echo number_format($detail['price'], 0, ',', '.'); ?>đ</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include 'Lib/footer.php'; ?>
</body>
</html>
