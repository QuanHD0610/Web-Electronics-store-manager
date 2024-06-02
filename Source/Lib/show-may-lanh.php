<?php include ('Lib/san-pham-theo-loai.php') ?>
<section class="may-lanh">
    <div class="container mt-5">
        <div class="banner-may-lanh">
            <img src="Image/may-lanh-gia-so_152_1200.png" alt="">
        </div>
        <div class="product-show d-flex align-content-start flex-wrap">
            <?php
            $count = 0;
            foreach ($ds_dien_may as $item) {
                if ($item['category_id'] == 2 && $count < 10) {
                    $count++; ?>
                    <div class="card  border-info border-2 d-flex justify-content-around">
                        <div class="card-top">
                            <a href="detail_product.php?product_id=<?php echo $item['product_id'] ?>">
                                <img src="Images/<?php echo $item['img'] ?>" class="card-img-top img-fluid "
                                    style="margin-top:100px;margin-bottom:50px;" alt="...">
                            </a>
                            <img src="Image/giam-gia.png" alt="" class="giam-gia">
                        </div>
                        <div class="card-body pt-1">
                            <h5 class="card-title"><strong><?php echo $item['product_name'] ?></strong></h5>
                            <p class="card-text text-danger fw-bold">Rẻ Hơn: <span
                                    class="fs-5"><?php echo number_format($item['price_km'], 0, ',', '.') ?> <sup>đ</sup>
                            </p>
                            <div class="d-flex align-items-center">
                                <div class="text-decoration-line-through"><?php echo number_format($item['price'], 0, ',', '.') ?> <sup>đ</sup></div>
                                <div class="bg-danger text-white px-2 py-1 fs-6 rounded"><?php echo $item['Km'] ?>%</div>
                            </div>
                            <p class="card-text my-1" style="font-size: 13px;">Quà tặng trị giá <strong>12.600.000đ</strong></p>
                            <div class="d-flex align-items-center text-primary my-2">
                                <svg class="bi bi-check-circle-fill me-2" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 0a8 8 0 110 16A8 8 0 018 0zm4.354 4.646a.5.5 0 00-.708-.708L7 9.293 5.354 7.646a.5.5 0 10-.708.708l2 2a.5.5 0 00.708 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-primary fw-bold" style="font-size: 10px;">Hoàn tiền gấp đôi nếu đâu Rẻ
                                    hơn</span>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>

        <div class="product-show  d-flex justify-content-center align-items-center">
            <div class="show-all text-center  mx-auto my-auto" style="height: 40px;">
                <div class="show-text bg-white " style="height: 35px; width:50rem  ;">
                    <a href="search.php?category_name=Máy lạnh"
                        class="bg-white text-primary fw-bold text-decoration-none" style="height: 30px;">xem
                        tất cả</a>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>