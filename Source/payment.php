<?php
session_start();

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Kết nối cơ sở dữ liệu
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Lấy giá trị của phương thức thanh toán từ form
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
// Kiểm tra dữ liệu POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['email'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    // In ra các giá trị đã nhận được từ form
    echo "Tên: " . $name . "<br>";
    echo "Số điện thoại: " . $phone . "<br>";
    echo "Địa chỉ: " . $address . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Phương thức thanh toán: " . $payment_method . "<br>";

    
    if (isset($_SESSION['customer_id'], $_SESSION['totalCounter'], $_SESSION['cart'])) {
        try {

            // Bắt đầu giao dịch
            $pdo->beginTransaction();

            // 1. Chèn dữ liệu vào bảng order_customer
            $sql_insert_order = "INSERT INTO order_customer (customer_id, order_date, total_amount, payment) VALUES (:customer_id, NOW(), :total_amount, :payment)";
            $stmt_order = $pdo->prepare($sql_insert_order);
            $stmt_order->execute([
                ':customer_id' => $_SESSION['customer_id'],
                ':total_amount' => $_SESSION['totalCounter'],
                ':payment' => $payment_method
            ]);

            $order_id = $pdo->lastInsertId();

            // 2. Chèn dữ liệu vào bảng order_detail
            $sql_insert_order_detail = "INSERT INTO order_detail (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $stmt_detail = $pdo->prepare($sql_insert_order_detail);

            foreach ($_SESSION['cart'] as $item) {
                $stmt_detail->execute([
                    ':order_id' => $order_id,
                    ':product_id' => $item['product_id'],
                    ':quantity' => $item['sl'],
                    ':price' => $item['price_km']
                ]);
            }

            // 3. Gửi email xác nhận
            $mail = new PHPMailer(true);
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'hoangquan12092003@gmail.com';
            $mail->Password = 'zsctlnnzueuhrzib';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Thông tin người gửi
            $mail->setFrom('hoangquan12092003@gmail.com', 'MiLo Electric');
            $mail->addAddress($email, $name);

            // Nội dung email
            $order_details_html = '';
            foreach ($_SESSION['cart'] as $item) {
                $order_details_html .= "<tr><td>{$item['product_id']}</td><td>{$item['sl']}</td><td>{$item['price_km']}</td></tr>";
            }

            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận đơn hàng';
            $mail->Body = "<p>Chào $name,</p>
                            <p>Cảm ơn bạn đã đặt hàng. Thông tin đơn hàng của bạn như sau:</p>
                            <p>Họ và tên: $name</p>
                            <p>Số điện thoại: $phone</p>
                            <p>Địa chỉ: $address</p>
                            <p>Phương thức thanh toán: $payment_method</p>
                            <table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>
                                <tr><th>Mã sản phẩm</th><th>Số lượng</th><th>Giá</th></tr>
                                $order_details_html
                            </table>
                            <p>Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
                            <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>";

            $mail->send();

            // Cam kết giao dịch
            $pdo->commit();

            echo "<center><div style='height:450px'>Đơn hàng đã được đặt thành công và email xác nhận đã được gửi.</div></center>";

            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);
            unset($_SESSION['totalCounter']);

            // Chuyển hướng về trang chủ
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            // Roll back giao dịch nếu xảy ra lỗi
            $pdo->rollBack();
            echo "Đơn hàng đã được đặt, nhưng không thể gửi email xác nhận. Lỗi gửi email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Session variables are not set.";
    }
} else {
    echo "Form data is incomplete.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/pro.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php include 'Lib/ten-loai.php' ?>

<body>
    <?php include 'Lib/header.php'; ?>
    <section class="payment">
        <div class="container">
            <div class="payment-top-wap">
                <div class="payment-top">
                    <div class="payment-top-cart payment-top-item">
                        <i class="fas fa-shopping-cart "></i>
                    </div>
                    <div class="payment-top-adress payment-top-item">
                        <i class="fas fa-map-marker-alt "></i>
                    </div>
                    <div class="payment-top-payment payment-top-item">
                        <i class="fas fa-money-check-alt "></i>
                    </div>
                </div>
            </div>
            <form action="payment.php" method="post">
                <div class="container">
                    <div class="payment-content row">
                        <div class="payment-content-left">
                            <div class="payment-content-left-method-delivery">
                                <p style="font-weight: bold;">Phương thức giao hàng</p>
                                <div class="payment-content-left-method-delivery-item">
                                    <input type="radio" checked> <label for="">Giao hàng chuyển phát nhanh</label>
                                    <p style="font-size: 10px;">Chuyển tới địa chỉ khách hàng</p>
                                </div>
                            </div>
                            <div class="payment-content-left-method-payment">
                                <p style="font-weight: bold;">Phương thức thanh toán</p>
                                <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại.</p>
                                <div class="payment-content-left-method-payment-item">
                                    <input type="radio" name="payment_method" value="credit_card">
                                    <label for="">Thanh toán bằng thẻ tín dụng (OnePay)</label>
                                </div>
                                <div class="payment-content-left-method-payment-item-img">
                                    <img src="images/visa.png" alt="">
                                </div>
                                <div class="payment-content-left-method-payment-item">
                                    <input type="radio" name="payment_method" value="debit_card">
                                    <label for="">Thanh toán bằng thẻ ATM (OnePay)</label>
                                </div>
                                <div class="payment-content-left-method-payment-item-img">
                                    <img src="images/visa.png" alt="">
                                </div>
                                <div class="payment-content-left-method-payment-item">
                                    <input type="radio" name="payment_method" value="momo">
                                    <label for="">Thanh toán bằng momo</label>
                                </div>
                                <div class="payment-content-left-method-payment-item-img">
                                    <img src="images/momo.png" alt="" height="35px">
                                </div>
                                <div class="payment-content-left-method-payment-item">
                                    <input type="radio" name="payment_method" value="cash" checked>
                                    <label for="">Thanh toán bằng tiền mặt</label>
                                </div>
                                <div class="payment-content-right-payment">
                                    <button type="submit" name="checkout">Tiếp tục thanh toán</button>
                                </div>
                            </div>
                        </div>
                        <div class="payment-content-right">
                            <div class="payment-content-right-button">
                                <input type="text" name="discount_code" placeholder="Nhập mã giảm giá">
                                <button type="button"><i class="fa-solid fa-check"></i></button>
                            </div>
                            <div class="payment-content-right-button">
                                <input type="text" name="affiliate_code" placeholder="Nhập mã cộng tác viên">
                                <button type="button"><i class="fa-solid fa-check"></i></button>
                            </div>
                            <div class="payment-content-right-mnv">
                                <select name="employee_code">
                                    <option value="">Chọn mã nhân viên thân thiết</option>
                                    <option value="1">Chọn mã nhân viên thân thiết 1</option>
                                    <option value="2">Chọn mã nhân viên thân thiết 2</option>
                                    <option value="3">Chọn mã nhân viên thân thiết 3</option>
                                    <option value="4">Chọn mã nhân viên thân thiết 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php include ("Lib/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
