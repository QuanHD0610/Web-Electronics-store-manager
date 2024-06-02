<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check for 'cart' SESSION
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        die("Không có sản phẩm trong giỏ hàng.");
    }

    $is_logged_in = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;

    // Initialize $customer to null
    $customer = null;

    // Get customer information if logged in
    if ($is_logged_in) {
        $sql = "SELECT * FROM customer WHERE customer_id = :customer_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':customer_id' => $is_logged_in]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Process POST data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize input data
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
        $total_amount = filter_input(INPUT_POST, 'total_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        echo $name . $phone .$address .$email .$total_amount;

        // Check for incomplete form data
        if (!$name || !$phone || !$address || !$email || !$payment_method || !$total_amount) {
            die("Form data is incomplete.");
        }

        try {
            $pdo->beginTransaction();

            // Get customer_id if logged in or insert new customer into database
            if ($is_logged_in) {
                $customer_id = $_SESSION['customer_id'];
            } else {
                $sql_insert_customer = "INSERT INTO customer (customer_name, phone_number, address, email) VALUES (:name, :phone, :address, :email)";
                $stmt_customer = $pdo->prepare($sql_insert_customer);
                $stmt_customer->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt_customer->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmt_customer->bindParam(':address', $address, PDO::PARAM_STR);
                $stmt_customer->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt_customer->execute();

                $customer_id = $pdo->lastInsertId();
            }

            // Insert order into database
            $sql_insert_order = "INSERT INTO order_customer (customer_id, order_date, total_amount, payment) VALUES (:customer_id, NOW(), :total_amount, :payment_method)";
            $stmt_order = $pdo->prepare($sql_insert_order);
            $stmt_order->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $stmt_order->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
            $stmt_order->bindParam(':payment_method', $payment_method, PDO::PARAM_STR);
            $stmt_order->execute();

            $order_id = $pdo->lastInsertId();

            // Insert order details into database
            $sql_insert_order_detail = "INSERT INTO order_detail (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $stmt_detail = $pdo->prepare($sql_insert_order_detail);

            foreach ($_SESSION['cart'] as $item) {
                $stmt_detail->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $stmt_detail->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
                $stmt_detail->bindParam(':quantity', $item['sl'], PDO::PARAM_INT);
                $stmt_detail->bindParam(':price', $item['price_km'], PDO::PARAM_STR);
                $stmt_detail->execute();
            }
            $pdo->commit();
            // Send confirmation email
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'hoangquan12092003@gmail.com';
            $mail->Password = 'lzlvgoqxfjldepwz';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->setFrom('hoangquan12092003@gmail.com', 'MiLo Electric');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = '=?UTF-8?B?' . base64_encode('Xác nhận đơn hàng') . '?=';
            $mail->Body = "<p>Chào $name,</p>
                <p>Cảm ơn bạn đã đặt hàng. Dưới đây là thông tin chi tiết đơn hàng của bạn:</p>
                <p><strong>Họ và tên:</strong> $name</p>
                <p><strong>Số điện thoại:</strong> $phone</p>
                <p><strong>Địa chỉ:</strong> $address</p>
                <p><strong>Phương thức thanh toán:</strong> $payment_method</p>
                <table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>";
            foreach ($_SESSION['cart'] as $item) {
                $mail->Body .= "<tr>
                        <td>{$item['product_id']}</td>
                        <td>{$item['product_name']}</td>
                        <td>{$item['sl']}</td>
                        <td>" . number_format($item['price_km'], 0, ',', '.') . "đ</td>
                    </tr>";
            }
            $mail->Body .= "</table>;
                <p><strong>Tổng tiền hàng:</strong> " . number_format($total_amount, 0, ',', '.') . "đ</p>
                <p>Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
                <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>";

            $mail->send();

            echo "<center><div style='height:450px'>Đơn hàng đã được đặt thành công và email xác nhận đã được gửi.</div></center>";
            unset($_SESSION['cart']);

            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            echo "Đơn hàng đã được đặt, nhưng không thể gửi email xác nhận. Lỗi gửi email: {$mail->ErrorInfo}";
        }

        $pdo->commit();
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
} catch (Exception $e) {
    echo "Đã xảy ra lỗi khi đặt hàng: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin giao hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/pro.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php include 'Lib/ten-loai.php'; ?>

<body>
    <?php include 'Lib/header.php'; ?>
    <section class="delivery">
        <div class="container">
            <div class="delivery-top-wap">
                <div class="delivery-top">
                    <div class="delivery-top-cart delivery-top-item">
                        <i class="fas fa-shopping-cart "></i>
                    </div>
                    <div class="delivery-top-adress delivery-top-item">
                        <i class="fas fa-map-marker-alt "></i>
                    </div>
                    <div class="delivery-top-pay delivery-top-item">
                        <i class="fas fa-money-check-alt "></i>
                    </div>
                </div>
            </div>
            <div class="container">
                <form action="" method="post">
                    <div class="delivery-content row">
                        <div class="delivery-content-left">
                            <p>Vui lòng chọn địa chỉ giao hàng</p>
                            <div class="delivery-content-left-dangnhap row">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <p>Đăng nhập( nếu bạn đã có tài khoản)</p>
                            </div>
                            <div class="delivery-content-left-khachle row">
                                <input type="radio" checked name="loaikhach" value="khachle">
                                <p><span style="font-weight: bold;">Khách lẽ</span>( nếu bạn không muốn lưu thông tin)
                                </p>
                            </div>
                            <div class="delivery-content-left-dangky row">
                                <input type="radio" name="loaikhach">
                                <p><span style="font-weight: bold;"><a href="register.php" class="btn btn-primary">Đăng
                                            kí</a></span>
                                </p>
                            </div>
                            <div class="delivery-content-left-input-top row">
                                <div class="delivery-content-left-input-top-item">
                                    <label for="customer_name">Họ tên <span style="color: red;">*</span></label>
                                    <input type="text" id="customer_name" name="name" value="<?php if ($is_logged_in != null)
                                        echo htmlspecialchars($customer['customer_name']); ?>" required>
                                </div>
                                <div class="delivery-content-left-input-top-item">
                                    <label for="phone_number">Điện thoại <span style="color: red;">*</span></label>
                                    <input type="text" id="phone_number" name="phone" value="<?php if ($is_logged_in != null)
                                        echo htmlspecialchars($customer['phone_number']); ?>" require>
                                </div>
                            </div>
                            <div class="delivery-content-left-input-top row">
                                <div class="delivery-content-left-input-top-item">
                                    <label for="gender">Giới tính <span style="color: red;">*</span></label>
                                    <input type="text" id="gender" name="gender" value="<?php if ($is_logged_in != null)
                                        echo htmlspecialchars($customer['gender']); ?>" require>
                                </div>
                                <div class="delivery-content-left-input-top-item">
                                    <label for="email">Email <span style="color: red;">*</span></label>
                                    <input type="text" id="email" name="email" value="<?php if ($is_logged_in != null)
                                        echo htmlspecialchars($customer['email']); ?>" required>
                                </div>
                            </div>
                            <div class="delivery-content-left-input-bottom">
                                <label for="address">Địa chỉ <span style="color: red;">*</span></label>
                                <input type="text" id="address" name="address" value="<?php if ($is_logged_in != null)
                                    echo htmlspecialchars($customer['address']); ?>" required>
                            </div>
                            <div class="payment-content-left-method-payment">
                                <p style="font-weight: bold;">Phương thức thanh toán</p>
                                <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ
                                    được lưu lại.</p>
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
                            <div class="delivery-content-left-button row">
                                <a href="cart.php">&#171; Quay lại giỏ hàng</a>

                            </div>
                        </div>

                        <div class="delivery-content-right">
                            <table>
                                <tr>
                                    <th>#</th>
                                    <th>Tên sản phẩm </th>
                                    <th>Số lượng </th>
                                    <th>Thành tiền </th>
                                </tr>
                                <?php
                                $totalCounter = 0;
                                $itemCounter = 0;
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $key => $item) {
                                        $imgUrl = htmlspecialchars($item["img"]);
                                        $price = htmlspecialchars($item["price_km"]);
                                        $total = (float) $item["price_km"] * (int) $item["sl"];
                                        $totalCounter += $total;
                                        $itemCounter += $item["sl"];
                                        ?>
                                        <tr>
                                            <td><img src="images/<?php echo $imgUrl ?>" alt="" height="100px" /></td>
                                            <td>
                                                <p><?php echo htmlspecialchars($item['product_name']) ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo htmlspecialchars($item['sl']); ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo number_format($total, 0, ',', '.') ?> <sup>đ</sup></p>
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                }
                                ?>
                                <input type="text" id="total_amount" name="total_amount"
                                    value="<?php echo $totalCounter ?>" readonly hidden>
                                <tr>
                                    <td style="font-weight: bold;" colspan="3">Tổng : </td>
                                    <td style="font-weight: bold;">
                                        <p><?php echo number_format($totalCounter, 0, ',', '.') ?> <sup>đ</sup></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;" colspan="3">Tổng tiền hàng: </td>
                                    <td style="font-weight: bold;">
                                        <p><?php echo number_format($totalCounter + ($totalCounter * 0.1), 0, ',', '.') ?>
                                            <sup>đ</sup>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
    </section>
    <?php include ("Lib/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>