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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php include 'Lib/ten-loai.php' ?>
<body>
    <?php  include 'Lib/header.php'; ?>
    <section class="menu-banner ">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <nav class="navbar navbar-expand-md navbar-light  flex-md-column">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav flex-md-column">
                                    <?php foreach($ds_category as $Item) {?>
                                    <li class="nav-item">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><a class="nav-link"
                                            href="search.php?category_name=<?php echo $Item['category_name']?>"><?php echo $Item['category_name']?></a>
                                    </li>
                                    <?php } ?>
                                    <li>
                                        <img data-src="//cdn11.dienmaycholon.vn/filewebdmclnew/DMCL21/Picture/Apro/Apro_icon_189/webp_700_300-300-iconsalesapsant_593.gif" src="//cdn11.dienmaycholon.vn/filewebdmclnew/DMCL21/Picture/Apro/Apro_icon_189/300-300-iconsalesapsant_593.gif" alt="icon-sale-sap-san-tl " class="lazy error" data-error="//cdn11.dienmaycholon.vn/filewebdmclnew/DMCL21/Picture/Apro/Apro_icon_189/300-300-iconsalesapsant_593.gif" width="100" height="100" data-was-processed="true">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-md-9">
                    <img name="myimage" class="myimage img-fluid" src="Image/image1.jpg" alt="Banner"
                        style="width: 100%; max-width: 1292px; height: 420px;margin-left:-10px">
                </div>
            </div>
            <div class="banner1">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <a href="#"><img src="Image/banner1.jpg" alt=""></a>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <a href="#"><img src="Image/banner2.jpg" alt=""></a>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <a href="#"><img src="Image/banner3.jpg" alt=""></a>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <?php include("Lib/show-may-lanh-giam-gia.php") ?>
    <?php include("Lib/show-may-lanh.php") ?>
    <?php include("Lib/show-tu-lanh.php") ?>
    <?php include("Lib/show-may-giat.php") ?>
    <?php include("Lib/footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script type="text/javascript">
            window.onload = function () {
                setTimeout(switchImage, 3000);
            }
            var current = 1;
            var numIMG = 6;
            function switchImage() {
                current++;
                // Thay thế hình
                document.images['myimage'].src = 'image/Image' + current + '.jpg';
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