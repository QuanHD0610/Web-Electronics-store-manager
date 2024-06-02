<section class="banner">
    <img src="Image/banner.jpg" class="img-fluid">
</section>
<section class="myHeader">
    <div class="container ">
        <div class="row">
            <div class="col-md-3 "> <i class="fa-solid fa-download"></i> <a href="#"
                    class="text-decoration-none text-primary"> Tải ứng dụng trên điện
                    thoại</a> </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-auto"><a href="#" class="text-decoration-none">Hệ thống gồm 98 chi nhánh</a>
                    </div>
                    <div class="col-md-auto"><a href="#" class="text-decoration-none"> Chính sách bảo hành & 35 ngày
                            đổi trả</a></div>
                    <div class="col-md-2"><a href="#" class="text-decoration-none">Góp ý và phản hồi</a></div>
                    <div class="col-md-2"><span><i class="fa-solid fa-gift"></i> </span><a href="view_order_customer.php"
                            class="text-decoration-none"> Theo dõi đơn
                            hàng</a></div>
                    <div class="col-md-2">
                        <a href="customer_info.php"><i class="fa fa-circle-user" aria-hidden="true"></i></a>
                        
                        <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        // Kiểm tra xem session 'user_id' có tồn tại không
                        if (isset($_SESSION['customer_id'])) {
                            // Nếu có, hiển thị nút "Đăng xuất"
                            echo '<a href="logout.php" class="text-decoration-none"> Đăng xuất</a>';
                        } else {
                            // Nếu không, hiển thị nút "Đăng nhập"
                            echo '<a href="login.php" class="text-decoration-none"> Đăng nhập</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mymenu-bar shadow p-1 mb-3 bg-body rounded">
    <div class="container ">
        <div class="col">
            <div class="row custom-height-menu-bar ">
                <div class="col-3  mx-auto my-auto"> <a href="./"><img src="Image/logo.jpg" class="img-fluid"></a>
                </div>
                <div class="col-9 text-center ">
                    <div class="row justify-content-md-center custom-suport">
                        <div class="col-md-auto">
                            <nav class="navbar ">
                                <form class="d-flex" role="search">
                                    <input class="form-control border-0 border-bottom border-3 border border-secondary"
                                        type="search" placeholder="Tìm kiếm thông tin sản phẩm" aria-label="Search"
                                        style="width: 16rem;" name="search_query">
                                    <button class="btnSearch" type="submit"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                    <script>
                                        document.querySelector('.btnSearch').addEventListener('click', function (event) {
                                            event.preventDefault(); // Ngăn chặn hành động mặc định của button

                                            // Lấy giá trị từ input search
                                            var searchQuery = document.querySelector('input[name="search_query"]').value;
                                            window.location.href = 'search.php?search_query=' + encodeURIComponent(searchQuery);
                                        });
                                    </script>

                                </form>
                            </nav>
                        </div>
                        <div class="col-md-auto mx-auto my-auto">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fa fa-shopping-cart"
                                        style="font-size:25px;margin-right: -10px;margin-left:10px;"></i>
                                </div>
                                <div class="col-auto">
                                    <a href="cart.php">Giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto mx-auto my-auto">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fa-regular fa-rectangle-list"
                                        style="font-size:30px;margin-right: -10px"></i>
                                </div>
                                <div class="col-auto ">
                                    <a href="#">Khiếu nại <br>
                                        <p class="fw-bold text-danger"> 09283091238 </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto mx-auto my-auto">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-phone" style="font-size:25px;margin-right: -10px"></i>
                                </div>
                                <div class="col-auto">
                                    <a href="#">Hotline bán hàng<p class="fw-bold text-danger"> 09283091238 </p> </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-auto mx-auto my-auto">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-headphones" style="font-size:30px;margin-right: -10px"></i>
                                </div>
                                <div class="col-auto">
                                    <a href="#">Tư vấn kĩ thuật<p class="fw-bold text-danger"> 09283091238 </p> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3  text-white  ">
                    <div class="list-product ">
                        <i class="fa fa-bars" aria-hidden="true"></i> <a href="#"
                            class="text-decoration-none fw-bold text-white ">Danh mục sản phẩm</a>
                    </div>
                </div>
                <div class="col-9 custom-sale">
                    <div class="row no-gutters">
                        <div class="col-md bg-danger ">
                            <a href="index.php#tu-lanh" onclick="scrollToElement('.tu-lanh')">Tủ lạnh giá giảm đến
                                50%</a>
                        </div>
                        <div class="col-md">
                            <a href="index.php#may-giat" onclick="scrollToElement('.may-giat')">Máy giặt giảm đến
                                50%</a>
                        </div>
                        <div class="col-md">
                            <a href="index.php#may-lanh" onclick="scrollToElement('.may-lanh')">Máy lạnh giảm đến
                                50%</a>
                        </div>
                        <script>
                            function scrollToElement(className) {
                                var element = document.querySelector(className);
                                if (element) {
                                    element.scrollIntoView({ behavior: 'smooth' });
                                }
                            }

                            window.onload = function () {
                                var hash = window.location.hash;
                                if (hash) {
                                    var element = document.querySelector(hash);
                                    if (element) {
                                        element.scrollIntoView({ behavior: 'smooth' });
                                    }
                                }
                            };
                        </script>
                        <div class="col-md"><a href="#">Trả góp 0% & khuyến mãi</a></div>
                        <div class="col-md"><a href="#">Kinh nghiệm mua sắm</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>