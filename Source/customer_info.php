<?php
    // Kiểm tra xem session đã được bắt đầu chưa
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['customer_id'])) {
        // Nếu chưa, chuyển hướng về trang đăng nhập
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/pro.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include("Lib/header.php") ?>
    <div class="container shadow">
        <h1 class="text-center">Thông tin khách hàng</h1>
        <?php
            // Kết nối đến cơ sở dữ liệu
            $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Lấy thông tin của khách hàng từ cơ sở dữ liệu
            $customer_id = $_SESSION['customer_id'];
            $stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = :customer_id");
            $stmt->execute(['customer_id' => $customer_id]);
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);

            // Đóng kết nối đến cơ sở dữ liệu
            $pdo = null;
        ?>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <p><strong>Họ và tên:</strong> <?php echo $customer['customer_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $customer['email']; ?></p>
                <p><strong>Tên tài khoản:</strong> <?php echo $customer['username']; ?></p>
                <p><strong>Giới tính:</strong> <?php echo $customer['gender']; ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo $customer['phone_number']; ?></p>
                <p><strong>Địa chỉ:</strong> <?php echo $customer['address']; ?></p>
                <!--Thêm các thông tin khác nếu cần-->
            </div>
        </div>
    </div>
    <?php include("Lib/footer.php") ?>
</body>

</html>
