<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/pro.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            border-radius: 5px;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .login-form input[type="submit"] {
            border-radius: 5px;
            padding: 12px 0;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .dflex {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<?php
session_start();

// Khai báo biến để lưu thông báo lỗi
$mess_error = "";

// Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem tên đăng nhập và mật khẩu đã được gửi từ biểu mẫu không
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        // Lấy tên đăng nhập từ biểu mẫu
        $username = $_POST["username"];
        // Lấy mật khẩu từ biểu mẫu
        $password = $_POST["password"];

        // Kết nối đến cơ sở dữ liệu
        $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Chuẩn bị câu truy vấn SQL để kiểm tra tên đăng nhập
        $sql = "SELECT * FROM customer WHERE username = :username";

        // Chuẩn bị và thực thi câu truy vấn
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':username' => $username));

        // Lấy kết quả trả về từ cơ sở dữ liệu
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra xem tài khoản có tồn tại không
        if ($user) {
            // So sánh mật khẩu đã mã hoá với mật khẩu từ biểu mẫu
            if (password_verify($password, $user['password_hash'])) {
                // Đặt session cho người dùng
                $_SESSION['customer_id'] = $user['customer_id'];
                $_SESSION['customer_name'] = $user['customer_name'];

                // Kiểm tra nếu tên đăng nhập là admin
                if ($username === 'admin') {
                    // Chuyển hướng đến trang quản trị
                    header("Location: Admin/admin.php");
                } else {
                    // Chuyển hướng đến trang chính
                    header("Location: index.php");
                }
                exit();
            } else {
                // Nếu mật khẩu không chính xác, hiển thị thông báo lỗi
                $mess_error = '<p class="text-danger">Tên đăng nhập hoặc mật khẩu không chính xác.</p>';
            }
        } else {
            // Nếu không tìm thấy tài khoản, hiển thị thông báo lỗi
            $mess_error = '<p class="text-danger">Tên đăng nhập hoặc mật khẩu không chính xác.</p>';
        }
    } else {
        // Nếu tên đăng nhập hoặc mật khẩu không được gửi từ biểu mẫu, hiển thị thông báo lỗi
        $mess_error = '<p class="text-danger">Vui lòng nhập đầy đủ thông tin!</p>';
    }
}
?>

<body>
    <?php include("Lib/header.php") ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <h2 class="login-title">Đăng nhập</h2>
                    <form class="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Tên đăng nhập" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Mật khẩu" required>
                        </div>
                        <div class="dflex">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            <a href="register.php" class="btn btn-primary btn-block">Đăng kí</a>
                        </div>
                    </form>
                    <?php echo $mess_error ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("Lib/footer.php") ?>
</body>

</html>
