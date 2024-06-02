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
<?php include 'Lib/ten-loai.php';
$category_name = isset($_GET['category_name']) ? $_GET['category_name'] : '';
?>

<body>
    <?php include 'Lib/header.php';
    include 'sort.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <form id="menu">
                    <ul class="main-menu">
                        <li>
                            <?php include 'category.php' ?>
                            <ul class="">
                                <?php foreach ($ds_category as $item) { ?>
                                    <li>
                                        <a href="search.php?category_name=<?php echo $item['category_name']; ?>"
                                            name="category_name">
                                            <?php echo $item['category_name']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="col-10">
                <div class="category-right">
                    <div class="row">
                        <div class="category-right-top-item">
                            <?php if (isset($_GET['category_name']) && $_GET['category_name'] != '') { ?>
                                <p>Sản phẩm <?php echo $_GET['category_name']; ?></p>
                            <?php } else { ?>
                                <p>Sản phẩm</p>
                            <?php } ?>
                        </div>
                        <div class="category-right-top-item">
                            <button>
                                <span>Bộ lọc</span><i class="fas fa-sort-down"></i>
                            </button>
                        </div>
                            <div class="category-right-top-item">
                            <form action="search.php" id="menu" method="get">
                                <select id="sortSelect" onchange="window.location.href=this.value">
                                    <option value="">Sắp xếp</option>
                                    <option value="search.php?sort=DESC">Giá cao đến thấp</option>
                                    <option value="search.php?sort=ASC">Giá thấp đến cao</option>
                                </select>
                                </form>
                            </div>
                    </div>
                    <div class=" d-flex align-content-start flex-wrap">
                        <?php
                        $count = 0;
                        foreach ($ds_dien_may as $item) {
                            if (1) {
                                $count++;
                                if ($item['category_id'] == 2) { ?>
                                    <div class="card border-primay  border-2 d-flex justify-content-around">
                                        <div class="card-top">
                                            <a href="detail_product.php?product_id=<?php echo $item['product_id'] ?>">
                                                <img src="Images/<?php echo $item['img'] ?>" class="card-img-top "
                                                    style="margin-top:100px;margin-bottom:50px;" alt="...">
                                            </a>
                                            <img src="Image/giam-gia.png" alt="" class="giam-gia">
                                        </div>
                                        <div class="card-body pt-1">
                                            <h5 class="card-title"><strong><?php echo $item['product_name'] ?></strong></h5>
                                            <p class="card-text text-danger fw-bold">Rẻ Hơn: <span class="fs-5">
                                                    <?php echo number_format($item['price_km'], 0, ',', '.'); ?></span> <sup>đ</sup>
                                            </p>
                                            <div class="d-flex align-items-center">
                                                <div class="text-decoration-line-through">
                                                    <?php echo number_format($item['price'], 0, ',', '.'); ?>
                                                    <!-- Định dạng giá tiền với phần phân cách phần nghìn -->
                                                </div>

                                                <div class="bg-danger text-white px-2 py-1 fs-6 rounded"><?php echo $item['Km'] ?>%
                                                </div>
                                            </div>
                                            <p class="card-text my-1" style="font-size: 13px;">Quà tặng trị giá
                                                <strong>12.600.000đ</strong>
                                            </p>
                                            <div class="d-flex align-items-center text-primary my-2">
                                                <svg class="bi bi-check-circle-fill me-2" width="1em" height="1em"
                                                    viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8 0a8 8 0 110 16A8 8 0 018 0zm4.354 4.646a.5.5 0 00-.708-.708L7 9.293 5.354 7.646a.5.5 0 10-.708.708l2 2a.5.5 0 00.708 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-primary fw-bold" style="font-size: 10px;">Hoàn tiền gấp đôi nếu
                                                    đâu Rẻ
                                                    hơn</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="card  border-primary border-2 d-flex justify-content-around">
                                        <div class="card-top">
                                            <a href="detail_product.php?product_id=<?php echo $item['product_id'] ?>">
                                                <img src="Images/<?php echo $item['img'] ?>" class="card-img-top" alt="...">
                                            </a>
                                            <img src="Image/giam-gia.png" alt="" class="giam-gia">
                                        </div>
                                        <div class="card-body pt-1">
                                            <h5 class="card-title"><strong><?php echo $item['product_name'] ?></strong></h5>
                                            <p class="card-text text-danger fw-bold">Rẻ Hơn: <span class="fs-5">
                                                    <?php echo number_format($item['price_km'], 0, ',', '.'); ?></span> <sup>đ</sup>
                                            </p>
                                            <div class="d-flex align-items-center">
                                                <div class="text-decoration-line-through">
                                                    <?php echo number_format($item['price'], 0, ',', '.'); ?>
                                                    <!-- Định dạng giá tiền với phần phân cách phần nghìn -->
                                                </div>

                                                <div class="bg-danger text-white px-2 py-1 fs-6 rounded"><?php echo $item['Km'] ?>%
                                                </div>
                                            </div>
                                            <p class="card-text my-1" style="font-size: 13px;">Quà tặng trị giá
                                                <strong>12.600.000đ</strong>
                                            </p>
                                            <div class="d-flex align-items-center text-primary my-2">
                                                <svg class="bi bi-check-circle-fill me-2" width="1em" height="1em"
                                                    viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8 0a8 8 0 110 16A8 8 0 018 0zm4.354 4.646a.5.5 0 00-.708-.708L7 9.293 5.354 7.646a.5.5 0 10-.708.708l2 2a.5.5 0 00.708 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-primary fw-bold" style="font-size: 10px;">Hoàn tiền gấp đôi nếu
                                                    đâu Rẻ
                                                    hơn</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        } ?>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <?php
                    // Display pagination links
                    echo "<div class='pagination'>";
                    // First and Previous links
                    if ($current_page > 1) {
                        echo "<a href='search.php?category_name={$category_name}&page=1'>First</a>";
                        echo "<a href='search.php?category_name={$category_name}&page=" . ($current_page - 1) . "'>Previous</a>";
                    }

                    // Page links
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo "<a class='page-link active' href='search.php?category_name={$category_name}&page={$i}'>{$i}</a>";
                        } else {
                            echo "<a class='page-link' href='search.php?category_name={$category_name}&page={$i}'>{$i}</a>";
                        }
                    }

                    // Next and Last links
                    if ($current_page < $total_pages) {
                        echo "<a href='search.php?category_name={$category_name}&page=" . ($current_page + 1) . "'>Next</a>";
                        echo "<a href='search.php?category_name={$category_name}&page={$total_pages}'>Last</a>";
                    }

                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>
        <?php include("Lib/footer.php") ?>

</body>

</html>