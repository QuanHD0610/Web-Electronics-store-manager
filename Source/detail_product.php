<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="Css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/pro.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php include 'Lib/ten-loai.php' ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
    }
}
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->query("set names 'utf8'");
if (!empty($product_id)) {
    $sql_select = "SELECT * FROM product,brand WHERE product.brand_id=brand.brand_id AND product_id= " . $product_id;
    $product = $pdo->query($sql_select)->fetch(PDO::FETCH_ASSOC);
}
$pdo = null;
?>

<body>
    <?php include 'Lib/header.php'; ?>
    <section>
        <div class="container mt-5 shadow ">
            <div class="row">
                <div class="col-md-6">
                    <img src="Images/<?php echo $product['img'] ?>" alt="">
                    <div class="description border-top border-dark mt-5 ">
                        <p class="fw-bold">Tính năng nổi bật</p>
                        <p><?php echo $product['description'] ?> </p>
                        <p><?php echo $product['specification'] ?> </p>
                    </div>
                    <div class="doc-quyen border-top border-dark mt-5">
                        <p class="fw-bold">Độc quyền khi mua tại cửa hàng </p>
                        <ul class="item-doc-quyen">
                            <i></i>
                            <li>Hàng chính hãng 100%</li>
                            <i></i>
                            <li>Hoàn chênh lệch nếu siêu thị khác rẻ hơn</li>
                            <i></i>
                            <li>Giao hàng miễn phí tận nơi</li>
                            <i></i>
                            <li>Đổi trả trong 35 ngày (Nếu do lỗi kỹ thuật)</li>
                            <i></i>
                            <li>Bảo hành chính hãng 2 năm, có người đến tận nhà (Chính sách)</li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="mt-4 fw-bold fs-5"> <?php echo $product['product_name'] ?> </p>
                    <p> <span> Thương hiệu </span>: <span class="text-primary">
                            <?php echo $product['brand_name'] ?></span></p>
                    <p class="border-top border-dark mt-1 text-success fw-bold"><?php if ($product['stock_quantity'] > 0) {
                        echo 'CÒN HÀNG';
                    } else
                        echo 'HẾT HÀNG';
                    ?></p>
                    <p>Giá bán </p>
                    <p>
                        <span
                            class="fs-4 text-danger fw-bold"><?php echo number_format($product['price_km'], 0, ',', '.') ?>₫</span>
                        <span class="text-decoration-line-through">
                            <?php echo number_format($product['price'], 0, ',', '.') ?>₫
                        </span>
                        <span class="bg-primary text-white px-2 py-1 fs-6 rounded">-<?php echo $product['Km'] ?>%</span>
                        Trả góp 0%
                    </p>
                    <?php $saving = $product['price'] - $product['price_km']; ?>
                    <p>(Tiết kiệm: <span class="fw-bold"><?php echo number_format($saving, 0, ',', '.') ?> ₫</span>)</p>
                    <div class="uu-dai border m-1 p-2">
                        <p class="text-danger fw-bold"> Ưu đãi kèm theo </p>
                        <ul class="border-top ">
                            <li>Đổi Trả Trong 35 Ngày Nếu Có Lỗi Kỹ Thuật</li>
                            <li>Hoàn Tiền Nếu Siêu Thị Khác Rẻ Hơn (chính sách)</li>
                            <li>Trả Góp 0% Qua Công Ty Tài Chính và Ngân Hàng (xem chi tiết)</li>
                            <li>Tặng Voucher Lên Đến 600.000đ Khi Đăng Ký Mở Thẻ Tín Dụng VPBank Trên SenID</li>
                        </ul>
                    </div>
                    <form class="form-inline" method="POST" action="cart.php">
                        <div class="form-group mb-2" style="margin-right:10px;">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                            <input type="hidden" name="img" value="<?php echo $product['img'] ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product['product_name'] ?>">
                            <input type="hidden" name="price_km" value="<?php echo $product['price_km'] ?>">
                            <div class="d-flex flex-row align-items-start mt-3">
                                    <input type="number" name="sl" id="productQty" class="form-control"
                                        placeholder="Quantity" min="1" max="1000" value="1" size="7"
                                        style="margin-right:30px;width:60px;height:50px;">
                                <button type="submit" class="btn btn-primary btn-lg" style="float:right;"
                                    name="add_to_cart" value="add to cart">CHO VÀO GIỎ</button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <?php include ("Lib/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script type="text/javascript">
            window.onload = function () {
                setTimeout(switchImage, 3000);
            }
            var current = 1;
            var numIMG = 7;
            function switchImage() {
                current++;
                // Thay thế hình
                document.images['myimage'].src = '/image/image' + current + '.png';
                // Kiểm tra nếu đã đạt đến hình cuối cùng
                if (current === numIMG) {
                    // Thực hiện hành động mong muốn sau khi hiển thị hình cuối cùng
                    console.log("Hiển thị hình cuối cùng");
                    // Đặt lại current về 1 để bắt đầu lại từ đầu
                    current = 1;
                }
                // Gọi lại hàm setTimeout để chuyển đến hình tiếp theo
                setTimeout(switchImage, 3000);
            }
        </script>
</body>

</html>