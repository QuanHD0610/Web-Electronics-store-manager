<?php
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->query("set names 'utf8'");

$ds_dien_may = [];
//Khởi tạo danh sách loại sản phẩm
$may_giat = [];
$may_lanh = [];
$may_loc_kk = [];
$may_loc_nuoc = [];
$may_say = [];
$quat = [];
$quat_may = [];
$tu_lanh = [];

$sql_loai = "SELECT * FROM product";
$ds_dien_may = $pdo->query($sql_loai);

$sql_loai = "SELECT * FROM product";
        $ds_dien_may = $pdo->query($sql_loai)->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["search_query"])) {
    // Nhận dữ liệu từ form
    $search_query = $_GET["search_query"];

    // Kiểm tra nếu $search_query có giá trị
    if (!empty($search_query)) {
        // Truy vấn SQL để lấy các sản phẩm phù hợp
        $sql_loai = "SELECT * FROM product WHERE product_name LIKE ?";
        $stmt = $pdo->prepare($sql_loai);
        $stmt->execute(["%$search_query%"]);

        // Lấy kết quả truy vấn vào mảng
        $ds_dien_may = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Nếu không có từ khóa tìm kiếm, hiển thị tất cả sản phẩm
        $sql_loai = "SELECT * FROM product";
        $ds_dien_may = $pdo->query($sql_loai)->fetchAll(PDO::FETCH_ASSOC);
    }
}
$category_id = "";
// Lấy category_name từ tham số truy vấn của URL
if (isset($_GET['category_name'])) {
    $category_name = $_GET['category_name'];
    // Truy vấn SQL để lấy category_id từ category_name
    $sql = "SELECT category_id FROM category WHERE category_name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$category_name]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra xem đã lấy được category_id hay không
    if ($result) {
        $category_id = $result['category_id'];
        // Thực hiện truy vấn SQL để lấy danh sách sản phẩm với category_id
        $sql_products = "SELECT * FROM product WHERE category_id = ?";
        $stmt_products = $pdo->prepare($sql_products);
        $stmt_products->execute([$category_id]);
        $ds_dien_may = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Nếu không tìm thấy category_id, có thể xử lý nó theo cách khác
        // Ví dụ: hiển thị thông báo lỗi hoặc chuyển hướng đến trang mặc định
    }
}

// Phân loại sản phẩm vào các danh mục khác nhau
foreach ($ds_dien_may as $product) {
    switch ($product['category_id']) {
        case '1':
            $tu_lanh[] = $product;
            break;
        case '2':
            $may_lanh[] = $product;
            break;
        case '3':
            $may_giat[] = $product;
            break;
        case '4':
            $may_say[] = $product;
            break;
        case '5':
            $may_loc_nuoc[] = $product;
            break;
        case '6':
            $may_loc_kk[] = $product;
            break;
        case '7':
            $quat[] = $product;
            break;
        case '8':
            $quat_may[] = $product;
            break;
        default:
            // Nếu không rơi vào bất kỳ danh mục nào, thêm vào danh mục mặc định
            // Đây có thể là một sự lựa chọn hoặc bạn có thể xử lý nó theo cách khác
            break;
    }
}

$pdo = null;
?>