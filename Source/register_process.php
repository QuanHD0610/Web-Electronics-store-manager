<?php
// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem tất cả các trường dữ liệu có tồn tại và không rỗng không
    if (
        isset($_POST['fullname'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['gender'], $_POST['phoneNumber'], $_POST['address']) &&
        !empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['username']) &&
        !empty($_POST['password']) && !empty($_POST['gender']) && !empty($_POST['phoneNumber']) && !empty($_POST['address'])
    ) {
        // Kết nối đến cơ sở dữ liệu
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Kiểm tra xem username đã tồn tại chưa
            $stmt_check_username = $pdo->prepare("SELECT COUNT(*) FROM customer WHERE username = :username");
            $stmt_check_username->execute([':username' => $_POST['username']]);
            $username_exists = $stmt_check_username->fetchColumn();

            if ($username_exists) {
                echo "Tên người dùng đã tồn tại. Vui lòng chọn một tên người dùng khác.";
            } else {
                // Hash mật khẩu
                $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

                // Thêm dữ liệu vào bảng customer
                $sql = "INSERT INTO customer (customer_name, email, username, gender, password_hash, address, phone_number, role) 
                VALUES (:fullname, :email, :username, :gender, :password_hash, :address, :phone_number, 'user')";

                // Chuẩn bị và thực thi câu truy vấn
                $stmt = $pdo->prepare($sql);
                $stmt->execute(
                    array(
                        ':fullname' => $_POST['fullname'],
                        ':email' => $_POST['email'],
                        ':gender' => $_POST['gender'],
                        ':username' => $_POST['username'],
                        ':password_hash' => $password_hashed,
                        ':address' => $_POST['address'],
                        ':phone_number' => $_POST['phoneNumber']
                    )
                );

                echo "Tài khoản đã được tạo thành công.";

                header("Location: login.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Đóng kết nối đến cơ sở dữ liệu
            $pdo = null;
        }
    } else {
        // Nếu không đủ dữ liệu được gửi từ form, hiển thị thông báo lỗi
        echo "Vui lòng điền đầy đủ thông tin!";
    }
}
?>