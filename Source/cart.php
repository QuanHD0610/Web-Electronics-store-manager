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
// GIỎ HÀNG
session_start();
// Nếu chưa tồn tại thì khởi tạo giỏ
if (!isset($_SESSION['cart']))
  $_SESSION['cart'] = [];

//Xóa ALL giỏ
if (isset($_GET['emptyCart']) && ($_GET['emptyCart'] == 1))
  unset($_SESSION['cart']);

//Xóa item trong Giỏ
if (isset($_GET['delId']) && ($_GET['delId'] >= 0)) {
  // unset($_SESSION['cart'][$_GET['delId']]);
  array_splice($_SESSION['cart'], $_GET['delId'], 1);
}

// Update item trong giỏ
if (isset($_GET['updateId']) && ($_GET['updateId'] >= 0)) {
  $index = $_GET['updateId'];
  if (isset($_SESSION['cart'][$index])) {
    $new_quantity = $_GET['num_sl']; // Số lượng mới
    $_SESSION['cart'][$index]['sl'] = $new_quantity;
  }
}

//Lấy dl từ form Xem Chi Tiết
if (isset($_POST['add_to_cart']) && ($_POST['add_to_cart'])) {
  $maMon = $_POST['product_id'];
  $tenMon = $_POST['product_name'];
  $hinh = $_POST['img'];
  $donGia = $_POST['price_km'];
  $sl = $_POST['sl'];

  //Kiểm tra SP có trong giỏ hàng hay không 
  /* $flag = 0;
   foreach( $_SESSION['cart'] as $key=>&$item )
  {
      if($item['maMon']== $maMon)
      {
          $flag = 1;
          $sl_new= $sl + $item['sl'];
          $item['sl'] = $sl_new;
          $_SESSION['cart'][$key] = $item;
          break;
      }
  } */
  $flag = 0;
  $count = count($_SESSION['cart']);
  for ($i = 0; $i < $count; $i++) {
    $item = $_SESSION['cart'][$i];
    if ($item["product_id"] == $maMon) {
      $flag = 1;
      $sl_new = $sl + $item["sl"];
      $item["sl"] = $sl_new; // Cập nhật số lượng trực tiếp trong mảng $_SESSION['cart']
      $_SESSION['cart'][$i] = $item;
      break;
    }
  }

  //Thêm SP vào giỏ nếu kg trùng
  if ($flag == 0) {
    // $sp = [$maMon,$tenMon, $hinh,$donGia,$sl];
    $sp = array(
      'product_id' => $maMon,
      'product_name' => $tenMon,
      'img' => $hinh,
      'price_km' => $donGia,
      'sl' => $sl,
    );
    $_SESSION['cart'][] = $sp;
  }
}

?>

<body>
  <?php include 'Lib/header.php'; ?>
  <section>
    <div class="container">
      <div class="cart-top-wap">
        <div class="cart-top">
          <div class="cart-top-cart cart-top-item">
            <i class="fas fa-shopping-cart "></i>
          </div>
          <div class="cart-top-adress cart-top-item">
            <i class="fas fa-map-marker-alt "></i>
          </div>
          <div class="cart-top-pay cart-top-item">
            <i class="fas fa-money-check-alt c"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="cart-content row">
        <?php if (empty($_SESSION['cart'])) { ?>
          <table class="table">
            <tr>
              <td>
                <p>Your cart is emty</p>
              </td>
            </tr>
          </table>
          <?php
        } ?>
        <div class="cart-content-left">
          <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <table>
              <tr>
                <th>Sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>SL</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
              </tr>
              <?php
              $totalCounter = 0;
              $itemCounter = 0;
              $count = count($_SESSION['cart']);
              for ($i = 0; $i < $count; $i++) {
                $item = $_SESSION['cart'][$i];
                //foreach($_SESSION['cart'] as $key => $item){
                $imgUrl = $item["img"];
                $price = $item["price_km"];
                $total = (float) $item["price_km"] * (int) $item["sl"];
                $totalCounter += $total;
                $_SESSION['totalCounter'] = $totalCounter;
                $itemCounter += $item["sl"];
                ?>
                <tr>
                  <td><img src="images/<?php echo $imgUrl ?>" alt="" class="img-fluid" /></td>
                  <td>
                    <p><?php echo $item['product_name'] ?></p>
                  </td>
                  <td>
                    <form action="cart.php" method="get">
                      <input type="hidden" name="updateId" value="<?php echo $i ?>">
                      <input type="number" name="num_sl" class="cart-qty-single" data-item="<?php echo $key ?>"
                        value="<?php echo $item['sl']; ?>" min="1" max="1000" width="70px">
                      <button type="submit" class="text-primary bg-white"><i
                          class="fa-regular fa-floppy-disk text-primary"></i></button>
                    </form>
                  </td>
                  <td>
                    <p><?php echo number_format($total, 0, ',', '.') ?> <sup>đ</sup></p>
                  </td>
                  <td> <a href="cart.php?delId=<?php echo $i ?>" class="text-danger">
                      <i class="fa-solid fa-trash"></i>
                    </a></td>
                </tr>
              <?php } ?>
              <tr class="border-top border-bottom">
                <td><a class="btn btn-danger btn-sm" href="cart.php?emptyCart=1">Clear Cart</a></td>
                <td></td>
              </tr>
            </table>

          </div>
          <div class="cart-content-right">
            <table>
              <tr>
                <th colspan="2">Tổng tiền giỏ hàng</th>
              </tr>
              <tr>
                <td>Tổng sản phẩm:</td>
                <td><?php
                echo ($itemCounter == 1) ? $itemCounter . ' Số lượng:' : $itemCounter; ?></td>
              </tr>
              <tr>
                <td>Tổng tiền hàng:</td>
                <td>
                  <p><?php echo number_format($totalCounter, 0, ',', '.') ?> <sup>đ</sup></p>
                </td>
              </tr>
              <tr>
                <td>Thành tiền:</td>
                <td>
                  <p><?php echo number_format($totalCounter, 0, ',', '.') ?> <sup>đ</sup></p>
                </td>
              </tr>
              <tr>
                <td>Tạm tính</td>
                <td>
                  <p style="color: black; font-weight: bold">
                    <strong>
                      <p><?php echo number_format($totalCounter, 0, ',', '.') ?> <sup>đ</sup></p>
                </td>
              </tr>
            </table>
            <?php ?>
            <div class="cart-content-right-text">
              <p>
                Bạn được miễn phí ship khi tổng giá trị hàng trên 1.000.000 VNĐ.
              </p>
              <p style="color: red; font-weight: bold">
                Mua thêm <span style="font-size: 18px"> 200.000VNĐ </span> được
                miễn phí ship
              </p>
            </div>
            <div class="cart-content-right-button">
              <button><a href="index.php" class="btn">Tiếp tục mua sắm</a></button>
              <button onclick="redirectToPaymentPage()">Thanh toán</button>

              <script>
                function redirectToPaymentPage() {
                  // Thực hiện chuyển hướng sang trang thanh toán
                  window.location.href = "delivery.php";
                }
              </script>

            </div>
            <div class="cart-content-right-dangnhap">
              <p>Tài khoản HQ</p>
              <p>
                Hãy <a href="">Đăng nhập</a> tài khoản của bạn để tích điểm
                thành viên
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>
  <?php include ("Lib/footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <!-- <script type="text/javascript">
            window.onload = function () {
                setTimeout(switchImage, 3000);
            }
            var current = 1;
            var numIMG = 7;
            function switchImage() {
                current++;
                // Thay thế hình
                document.images['myimage'].src = '/image/image' + current + '.jpg';
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
        </script> -->
</body>

</html>