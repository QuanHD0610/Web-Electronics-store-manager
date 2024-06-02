-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 02, 2024 lúc 08:40 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_cuahangdienmay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `description`) VALUES
(1, 'Samsung', 'Sáng tạo và tiên phong trong công nghệ điện tử'),
(2, 'LG', 'Một trong những thương hiệu hàng đầu về điện tử tiêu dùng'),
(3, 'Sony', 'Mang đến những sản phẩm chất lượng và đa dạng'),
(4, 'Panasonic', 'Cung cấp các sản phẩm điện tử chất lượng cao'),
(5, 'Toshiba', 'Đồng hành cùng gia đình trong mọi công việc'),
(6, 'Philips', 'Sự lựa chọn tin cậy cho công nghệ gia đình'),
(7, 'Sharp', 'Khẳng định vị thế vững mạnh trong ngành điện tử'),
(8, 'Haier', 'Mang lại sự tiện ích và hiệu suất cho gia đình'),
(9, 'Hitachi', 'Điều hòa không khí và thiết bị gia đình đa năng'),
(10, 'Dell', 'Giải pháp công nghệ toàn diện cho mọi nhu cầu'),
(11, 'Apple', 'Sự tinh tế và sáng tạo trong từng sản phẩm'),
(12, 'Acer', 'Kết nối và phát triển cùng công nghệ'),
(13, 'Asus', 'Đưa công nghệ vào cuộc sống hàng ngày'),
(14, 'Lenovo', 'Đồng hành cùng sự tiện lợi và hiệu suất'),
(15, 'Microsoft', 'Khám phá và tạo ra những giải pháp tiên tiến'),
(16, 'Canon', 'Nâng cao trải nghiệm sáng tạo với công nghệ hình ảnh'),
(17, 'Nikon', 'Thú vị và độc đáo trong mỗi sản phẩm máy ảnh'),
(18, 'Fujifilm', 'Sự chuyên nghiệp và sáng tạo trong nhiếp ảnh'),
(19, 'GoPro', 'Khám phá và ghi lại những khoảnh khắc đáng nhớ'),
(20, 'Bose', 'Âm thanh chất lượng cao và trải nghiệm đích thực');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Tủ lạnh'),
(2, 'Máy lạnh'),
(3, 'Máy giặt'),
(4, 'Máy sấy'),
(5, 'Máy lọc nước'),
(6, 'Máy lọc không khí'),
(7, 'Quạt điều hoà'),
(8, 'Quạt máy'),
(11, 'Tủ đông'),
(12, 'Tủ Mát');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `gender`, `address`, `phone_number`, `email`, `username`, `password_hash`, `role`) VALUES
(1, 'Hoàng Đức Quyền', 'Nam', 'Tân Phú', '01283091123', 'tina06102003@gmail.com', 'quyen', '$2y$10$mEQ4nGrrv4iIvwhvkKSmT.FQorarnaM36hai7TSHzTDElBfn4EkAG', 'user'),
(2, 'Nguyễn Thị Quỳnh Mai', 'Nữ', 'Tân Phú', '08372648212', 'tina06102003@gmail.com', 'quynhmai', '$2y$10$nvudzqNH3ILbayBs/8nn2OwYlTXUOrYOavovrjQ/lcdKbq0N1j9ba', 'user'),
(3, 'Admin', 'Nam', 'Tân Phú', '08372648212', 'hoangquan12092003@gmail.com', 'admin', '$2y$10$SSaOJALlUwert3kCsZo6UePhrTH.lA6BUZed4Po/.ZODAReKzYDNu', 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `salary` decimal(18,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_customer`
--

CREATE TABLE `order_customer` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_customer`
--

INSERT INTO `order_customer` (`order_id`, `customer_id`, `order_date`, `total_amount`, `payment`) VALUES
(8, 3, '2024-06-02 06:18:15', 560000.00, 'cash'),
(10, 3, '2024-06-02 06:20:54', 13160000.00, 'cash'),
(12, 3, '2024-06-02 06:22:24', 560000.00, 'cash');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(7, 8, 415, 1, 560000.00),
(10, 10, 415, 1, 560000.00),
(11, 10, 35, 1, 12600000.00),
(14, 12, 415, 1, 560000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_km` int(11) NOT NULL,
  `Km` int(11) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `specification` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `brand_id`, `category_id`, `price`, `price_km`, `Km`, `img`, `stock_quantity`, `description`, `specification`) VALUES
(31, 'Tủ lạnh Samsung Inverter 370L', 1, NULL, 15000000, 13500000, 10, 'tu-lanh001.webp', 10, 'Làm lạnh hiệu quả, dung tích rộng rãi, thiết kế hiện đại', 'Dung tích 360L, công nghệ Inverter, thiết kế hiện đại'),
(32, 'Tủ lạnh LG Side-by-Side 600L', 2, 1, 25000000, 22500000, 10, 'tu-lanh002.webp', 8, 'Thiết kế cửa hai chiều, dung tích lớn, tính năng làm lạnh tiên tiến', 'Dung tích 600L, thiết kế cửa hai chiều, công nghệ làm lạnh tiên tiến'),
(33, 'Tủ lạnh Panasonic No Frost 400L', 3, 1, 18000000, 16200000, 10, 'tu-lanh003.webp', 15, 'Làm lạnh không tạo hóng nhiệt, ngăn chứa rộng rãi, hiệu suất đáng tin cậy', 'Dung tích 400L, công nghệ No Frost, tính năng hiệu suất đáng tin cậy'),
(34, 'Tủ lạnh Toshiba Tiết kiệm điện 250L', 4, 1, 12000000, 10800000, 10, 'tu-lanh004.webp', 20, 'Vận hành tiết kiệm điện, thiết kế nhỏ gọn, chất liệu bền bỉ', 'Dung tích 250L, chế độ tiết kiệm điện, chất liệu bền bỉ'),
(35, 'Tủ lạnh Aqua Có máy làm đá tự động 300L', 5, 1, 14000000, 12600000, 10, 'tu-lanh005.webp', 12, 'Có máy làm đá tự động, ngăn chứa rộng rãi, thiết kế thẩm mỹ', 'Dung tích 300L, máy làm đá tự động, thiết kế thẩm mỹ'),
(36, 'Tủ lạnh Samsung FrostGuard 400L', 1, NULL, 15000000, 14550000, 3, 'tu-lanh013.webp', 10, 'Tủ lạnh công nghệ FrostGuard', 'Dung tích 400L, công nghệ FrostGuard chống đóng tuyết'),
(37, 'Tủ lạnh LG FreshCool 350L', 2, 1, 14000000, 13580000, 3, 'tu-lanh014.webp', 8, 'Tủ lạnh FreshCool 350L', 'Dung tích 350L, kiểu thiết kế tươi mới'),
(38, 'Tủ lạnh Panasonic EverChill 280L', 3, 1, 12000000, 11520000, 4, 'tu-lanh015.webp', 15, 'Tủ lạnh EverChill 280L', 'Dung tích 280L, tính năng EverChill duy trì độ lạnh'),
(39, 'Tủ lạnh Toshiba CrystalFrost 450L', 4, 1, 16000000, 15040000, 6, 'tu-lanh016.webp', 20, 'Tủ lạnh CrystalFrost 450L', 'Dung tích 450L, thiết kế sang trọng với CrystalFrost'),
(40, 'Tủ lạnh Aqua CoolWave 320L', 5, 1, 13000000, 12610000, 3, 'tu-lanh017.webp', 12, 'Tủ lạnh CoolWave 320L', 'Dung tích 320L, sóng lạnh CoolWave mát mẻ'),
(41, 'Tủ lạnh Hitachi GlacierFrost 500L', 6, 1, 17000000, 16150000, 5, 'tu-lanh018.webp', 18, 'Tủ lạnh GlacierFrost 500L', 'Dung tích 500L, công nghệ GlacierFrost giữ độ lạnh'),
(42, 'Tủ lạnh Mitsubishi FrostBlast 550L', 7, 1, 18000000, 17280000, 4, 'tu-lanh019.webp', 11, 'Tủ lạnh FrostBlast 550L', 'Dung tích 550L, công nghệ FrostBlast giữ độ tươi'),
(43, 'Tủ lạnh Sharp ArcticChill 600L', 8, 1, 19000000, 18240000, 4, 'tu-lanh020.webp', 16, 'Tủ lạnh ArcticChill 600L', 'Dung tích 600L, công nghệ ArcticChill duy trì độ lạnh'),
(44, 'Tủ lạnh Electrolux IceStorm 420L', 9, 1, 15000000, 14400000, 4, 'tu-lanh021.webp', 14, 'Tủ lạnh IceStorm 420L', 'Dung tích 420L, siêu tốc IceStorm giữ độ lạnh'),
(45, 'Tủ lạnh Haier FreezeZone 380L', 10, 1, 14000000, 13440000, 4, 'tu-lanh022.webp', 22, 'Tủ lạnh FreezeZone 380L', 'Dung tích 380L, vùng lạnh FreezeZone bảo quản thực phẩm'),
(46, 'Tủ lạnh Samsung CrystalCool 390L', 1, NULL, 13500000, 13230000, 2, 'tu-lanh023.webp', 10, 'Tủ lạnh CrystalCool 380L', 'Dung tích 380L, công nghệ CrystalCool giữ độ lạnh'),
(47, 'Tủ lạnh LG FrostFreeze 420L', 2, 1, 14500000, 14065000, 3, 'tu-lanh024.webp', 8, 'Tủ lạnh FrostFreeze 420L', 'Dung tích 420L, công nghệ FrostFreeze chống đóng tuyết'),
(48, 'Tủ lạnh Panasonic CoolBreeze 470L', 3, 1, 15500000, 15035000, 3, 'tu-lanh025.webp', 15, 'Tủ lạnh CoolBreeze 470L', 'Dung tích 470L, công nghệ CoolBreeze làm mát tự nhiên'),
(49, 'Tủ lạnh Toshiba FreezeTech 510L', 4, 1, 16500000, 16005000, 3, 'tu-lanh026.webp', 20, 'Tủ lạnh FreezeTech 510L', 'Dung tích 510L, công nghệ FreezeTech bảo quản thực phẩm'),
(50, 'Tủ lạnh Aqua IceMaster 445L', 5, NULL, 14800000, 14208000, 4, 'tu-lanh027.webp', 12, 'Tủ lạnh IceMaster 440L', 'Dung tích 440L, công nghệ IceMaster giữ độ tươi'),
(51, 'Tủ lạnh Hitachi ChillFrost 480L', 6, 1, 15800000, 15168000, 4, 'tu-lanh027.webp', 18, 'Tủ lạnh ChillFrost 480L', 'Dung tích 480L, công nghệ ChillFrost làm mát nhanh chóng'),
(52, 'Tủ lạnh Mitsubishi EcoFreeze 490L', 7, 1, 16000000, 15520000, 3, 'tu-lanh029.webp', 11, 'Tủ lạnh EcoFreeze 490L', 'Dung tích 490L, công nghệ EcoFreeze tiết kiệm năng lượng'),
(53, 'Tủ lạnh Sharp ArcticBlast 530L', 8, 1, 17000000, 16490000, 3, 'tu-lanh030.webp', 16, 'Tủ lạnh ArcticBlast 530L', 'Dung tích 530L, công nghệ ArcticBlast giữ độ lạnh'),
(54, 'Tủ lạnh Electrolux FrostGuardian 450L', 9, 1, 15000000, 14550000, 3, 'tu-lanh031.webp', 14, 'Tủ lạnh FrostGuardian 450L', 'Dung tích 450L, công nghệ FrostGuardian bảo quản thực phẩm'),
(55, 'Tủ lạnh Haier CoolFreeze 470L', 10, 1, 15500000, 15035000, 3, 'tu-lanh032.webp', 22, 'Tủ lạnh CoolFreeze 470L', 'Dung tích 470L, công nghệ CoolFreeze làm mát hiệu quả'),
(56, 'Tủ lạnh LG Side-by-Side 600L', 2, 1, 25000000, 22500000, 10, 'tu-lanh002.webp', 8, 'Thiết kế cửa hai chiều, dung tích lớn, tính năng làm lạnh tiên tiến', 'Dung tích 600L, thiết kế cửa hai chiều, công nghệ làm lạnh tiên tiến'),
(57, 'Tủ lạnh Panasonic No Frost 400L', 3, 1, 18000000, 16200000, 10, 'tu-lanh003.webp', 15, 'Làm lạnh không tạo hóng nhiệt, ngăn chứa rộng rãi, hiệu suất đáng tin cậy', 'Dung tích 400L, công nghệ No Frost, tính năng hiệu suất đáng tin cậy'),
(58, 'Tủ lạnh Toshiba Tiết kiệm điện 250L', 4, 1, 12000000, 10800000, 10, 'tu-lanh004.webp', 20, 'Vận hành tiết kiệm điện, thiết kế nhỏ gọn, chất liệu bền bỉ', 'Dung tích 250L, chế độ tiết kiệm điện, chất liệu bền bỉ'),
(59, 'Tủ lạnh Aqua Có máy làm đá tự động 300L', 5, 1, 14000000, 12600000, 10, 'tu-lanh005.webp', 12, 'Có máy làm đá tự động, ngăn chứa rộng rãi, thiết kế thẩm mỹ', 'Dung tích 300L, máy làm đá tự động, thiết kế thẩm mỹ'),
(60, 'Tủ lạnh Samsung FrostGuard 400L', 1, 1, 15000000, 14550000, 3, 'tu-lanh013.webp', 10, 'Tủ lạnh công nghệ FrostGuard', 'Dung tích 400L, công nghệ FrostGuard chống đóng tuyết'),
(61, 'Tủ lạnh LG FreshCool 350L', 2, 1, 14000000, 13580000, 3, 'tu-lanh014.webp', 8, 'Tủ lạnh FreshCool 350L', 'Dung tích 350L, kiểu thiết kế tươi mới'),
(62, 'Tủ lạnh Panasonic EverChill 280L', 3, 1, 12000000, 11520000, 4, 'tu-lanh015.webp', 15, 'Tủ lạnh EverChill 280L', 'Dung tích 280L, tính năng EverChill duy trì độ lạnh'),
(63, 'Tủ lạnh Toshiba CrystalFrost 450L', 4, 1, 16000000, 15040000, 6, 'tu-lanh016.webp', 20, 'Tủ lạnh CrystalFrost 450L', 'Dung tích 450L, thiết kế sang trọng với CrystalFrost'),
(64, 'Tủ lạnh Aqua CoolWave 320L', 5, 1, 13000000, 12610000, 3, 'tu-lanh017.webp', 12, 'Tủ lạnh CoolWave 320L', 'Dung tích 320L, sóng lạnh CoolWave mát mẻ'),
(65, 'Tủ lạnh Hitachi GlacierFrost 500L', 6, 1, 17000000, 16150000, 5, 'tu-lanh018.webp', 18, 'Tủ lạnh GlacierFrost 500L', 'Dung tích 500L, công nghệ GlacierFrost giữ độ lạnh'),
(66, 'Tủ lạnh Mitsubishi FrostBlast 550L', 7, 1, 18000000, 17280000, 4, 'tu-lanh019.webp', 11, 'Tủ lạnh FrostBlast 550L', 'Dung tích 550L, công nghệ FrostBlast giữ độ tươi'),
(67, 'Tủ lạnh Sharp ArcticChill 600L', 8, 1, 19000000, 18240000, 4, 'tu-lanh020.webp', 16, 'Tủ lạnh ArcticChill 600L', 'Dung tích 600L, công nghệ ArcticChill duy trì độ lạnh'),
(68, 'Tủ lạnh Electrolux IceStorm 420L', 9, 1, 15000000, 14400000, 4, 'tu-lanh021.webp', 14, 'Tủ lạnh IceStorm 420L', 'Dung tích 420L, siêu tốc IceStorm giữ độ lạnh'),
(69, 'Tủ lạnh Haier FreezeZone 380L', 10, 1, 14000000, 13440000, 4, 'tu-lanh022.webp', 22, 'Tủ lạnh FreezeZone 380L', 'Dung tích 380L, vùng lạnh FreezeZone bảo quản thực phẩm'),
(70, 'Tủ lạnh Samsung CrystalCool 380L', 1, 1, 13500000, 13230000, 2, 'tu-lanh023.webp', 10, 'Tủ lạnh CrystalCool 380L', 'Dung tích 380L, công nghệ CrystalCool giữ độ lạnh'),
(71, 'Tủ lạnh LG FrostFreeze 420L', 2, 1, 14500000, 14065000, 3, 'tu-lanh024.webp', 8, 'Tủ lạnh FrostFreeze 420L', 'Dung tích 420L, công nghệ FrostFreeze chống đóng tuyết'),
(72, 'Tủ lạnh Panasonic CoolBreeze 470L', 3, 1, 15500000, 15035000, 3, 'tu-lanh025.webp', 15, 'Tủ lạnh CoolBreeze 470L', 'Dung tích 470L, công nghệ CoolBreeze làm mát tự nhiên'),
(73, 'Tủ lạnh Toshiba FreezeTech 510L', 4, 1, 16500000, 16005000, 3, 'tu-lanh026.webp', 20, 'Tủ lạnh FreezeTech 510L', 'Dung tích 510L, công nghệ FreezeTech bảo quản thực phẩm'),
(74, 'Tủ lạnh Aqua IceMaster 440L', 5, 1, 14800000, 14208000, 4, 'tu-lanh027.webp', 12, 'Tủ lạnh IceMaster 440L', 'Dung tích 440L, công nghệ IceMaster giữ độ tươi'),
(75, 'Tủ lạnh Hitachi ChillFrost 480L', 6, 1, 15800000, 15168000, 4, 'tu-lanh027.webp', 18, 'Tủ lạnh ChillFrost 480L', 'Dung tích 480L, công nghệ ChillFrost làm mát nhanh chóng'),
(76, 'Tủ lạnh Mitsubishi EcoFreeze 490L', 7, 1, 16000000, 15520000, 3, 'tu-lanh029.webp', 11, 'Tủ lạnh EcoFreeze 490L', 'Dung tích 490L, công nghệ EcoFreeze tiết kiệm năng lượng'),
(77, 'Tủ lạnh Sharp ArcticBlast 530L', 8, 1, 17000000, 16490000, 3, 'tu-lanh030.webp', 16, 'Tủ lạnh ArcticBlast 530L', 'Dung tích 530L, công nghệ ArcticBlast giữ độ lạnh'),
(78, 'Tủ lạnh Electrolux FrostGuardian 450L', 9, 1, 15000000, 14550000, 3, 'tu-lanh031.webp', 14, 'Tủ lạnh FrostGuardian 450L', 'Dung tích 450L, công nghệ FrostGuardian bảo quản thực phẩm'),
(79, 'Tủ lạnh Haier CoolFreeze 470L', 10, 1, 15500000, 15035000, 3, 'tu-lanh032.webp', 22, 'Tủ lạnh CoolFreeze 470L', 'Dung tích 470L, công nghệ CoolFreeze làm mát hiệu quả'),
(205, 'Máy giặt Samsung Inverter 8kg', 1, 3, 12000000, 10800000, 10, 'may-giat052.webp', 10, 'Giặt sạch hiệu quả, nhẹ nhàng với quần áo, thiết kế dễ sử dụng', 'Dung tích 8kg, công nghệ Inverter, thiết kế dễ sử dụng'),
(206, 'Máy giặt LG Steam 9kg', 2, 3, 15000000, 13500000, 10, 'may-giat053.webp', 8, 'Làm sạch bằng hơi nước, dung tích lớn, các tùy chọn giặt tiên tiến', 'Dung tích 9kg, làm sạch bằng hơi nước, các tùy chọn giặt tiên tiến'),
(207, 'Máy giặt Panasonic Eco 7kg', 3, 3, 11000000, 9900000, 10, 'may-giat054.webp', 15, 'Vận hành tiết kiệm nước, làm sạch hiệu quả, chất liệu bền bỉ', 'Dung tích 7kg, vận hành tiết kiệm nước, chất liệu bền bỉ'),
(208, 'Máy giặt Toshiba QuickWash 10kg', 4, 3, 18000000, 16200000, 10, 'may-giat055.webp', 20, 'Chế độ giặt nhanh, dung tích lớn, vận hành tiết kiệm năng lượng', 'Dung tích 10kg, chế độ giặt nhanh, vận hành tiết kiệm năng lượng'),
(209, 'Máy giặt Aqua AquaWash 6kg', 5, 3, 9000000, 8100000, 10, 'may-giat056.webp', 12, 'Công nghệ giặt AquaWash, thiết kế nhỏ gọn, giá phải chăng', 'Dung tích 6kg, công nghệ giặt AquaWash, giá phải chăng'),
(210, 'Máy giặt Samsung AquaWash 8kg', 1, 3, 12000000, 10800000, 10, 'may-giat057.webp ', 10, 'Máy giặt công nghệ AquaWash', 'Dung tích 8kg, công nghệ AquaWash tiết kiệm nước'),
(211, 'Máy giặt LG TurboWash 9kg', 2, 3, 15000000, 13500000, 10, 'may-giat058.webp ', 8, 'Máy giặt công nghệ TurboWash', 'Dung tích 9kg, công nghệ TurboWash giặt nhanh hơn'),
(212, 'Máy giặt Panasonic Inverter 7kg', 3, 3, 11000000, 9900000, 10, 'may-giat059.webp ', 15, 'Máy giặt công nghệ Inverter', 'Dung tích 7kg, công nghệ Inverter tiết kiệm điện'),
(213, 'Máy giặt Toshiba QuickWash 10kg', 4, 3, 18000000, 16200000, 10, 'may-giat060.webp ', 20, 'Máy giặt chế độ giặt nhanh QuickWash', 'Dung tích 10kg, chế độ giặt nhanh QuickWash'),
(214, 'Máy giặt Aqua EcoWash 6kg', 5, 3, 9000000, 8100000, 10, 'may-giat061.webp ', 12, 'Máy giặt công nghệ EcoWash', 'Dung tích 6kg, công nghệ EcoWash tiết kiệm nước'),
(215, 'Máy giặt Hitachi Steam 8kg', 6, 3, 13000000, 11700000, 10, 'may-giat062.webp ', 18, 'Máy giặt công nghệ Steam', 'Dung tích 8kg, công nghệ Steam diệt khuẩn'),
(216, 'Máy giặt Mitsubishi AutoWash 7kg', 7, 3, 12500000, 11250000, 10, 'may-giat063.webp ', 11, 'Máy giặt chế độ giặt tự động AutoWash', 'Dung tích 7kg, chế độ giặt tự động AutoWash'),
(217, 'Máy giặt Sharp SuperWash 9kg', 8, 3, 14000000, 12600000, 10, 'may-giat064.webp ', 16, 'Máy giặt chương trình giặt SuperWash', 'Dung tích 9kg, chương trình giặt SuperWash'),
(218, 'Máy giặt Electrolux TimeCare 8kg', 9, 3, 13500000, 12150000, 10, 'may-giat065.webp ', 14, 'Máy giặt chế độ giặt TimeCare', 'Dung tích 8kg, chế độ giặt tiết kiệm thời gian TimeCare'),
(219, 'Máy giặt Haier SmartWash 7kg', 10, 3, 11500000, 10350000, 10, 'may-giat066.webp ', 22, 'Máy giặt chương trình giặt thông minh SmartWash', 'Dung tích 7kg, chương trình giặt thông minh SmartWash'),
(220, 'Máy giặt Samsung CrystalWash 8kg', 1, 3, 12000000, 10800000, 10, 'may-giat067.webp ', 10, 'Máy giặt công nghệ CrystalWash', 'Dung tích 8kg, công nghệ CrystalWash giữ màu sắc'),
(222, 'Máy giặt Panasonic QuickWash 7kg', 3, 3, 11000000, 9900000, 10, 'may-giat069.webp ', 15, 'Máy giặt chế độ giặt nhanh QuickWash', 'Dung tích 7kg, chế độ giặt nhanh QuickWash'),
(223, 'Máy giặt Toshiba EcoWash 6kg', 4, 3, 9000000, 8100000, 10, 'may-giat070.webp ', 20, 'Máy giặt công nghệ EcoWash', 'Dung tích 6kg, công nghệ EcoWash tiết kiệm nước'),
(224, 'Máy giặt Aqua SilentWash 9kg', 5, 3, 14000000, 12600000, 10, 'may-giat071.webp ', 12, 'Máy giặt chế độ giặt SilentWash', 'Dung tích 9kg, chế độ giặt SilentWash êm ái'),
(225, 'Máy giặt Hitachi DualWash 8kg', 6, 3, 13000000, 11700000, 10, 'may-giat072.webp ', 18, 'Máy giặt công nghệ DualWash', 'Dung tích 8kg, công nghệ DualWash giặt sạch hơn'),
(226, 'Máy giặt Mitsubishi GentleWash 7kg', 7, 3, 12000000, 10800000, 10, 'may-giat073.webp ', 11, 'Máy giặt chế độ giặt GentleWash', 'Dung tích 7kg, chế độ giặt GentleWash giữ vải mềm mại'),
(227, 'Máy giặt Sharp SpeedWash 9kg', 8, 3, 14000000, 12600000, 10, 'may-giat074.webp ', 16, 'Máy giặt chương trình giặt SpeedWash', 'Dung tích 9kg, chương trình giặt SpeedWash nhanh chóng'),
(228, 'Máy giặt Electrolux UltraCare 8kg', 9, 3, 13500000, 12150000, 10, 'may-giat075.webp ', 14, 'Máy giặt chế độ giặt UltraCare', 'Dung tích 8kg, chế độ giặt UltraCare bảo vệ vải'),
(229, 'Máy giặt Haier AquaWash 7kg', 10, 3, 11500000, 10350000, 10, 'may-giat076.webp ', 22, 'Máy giặt công nghệ AquaWash', 'Dung tích 7kg, công nghệ AquaWash tiết kiệm nước'),
(230, 'Máy giặt Samsung QuickWash 8kg', 1, 3, 12000000, 10800000, 10, 'may-giat077.webp ', 10, 'Máy giặt chế độ giặt QuickWash', 'Dung tích 8kg, chế độ giặt QuickWash nhanh chóng'),
(231, 'Máy giặt LG GentleCare 9kg', 2, 3, 15000000, 13500000, 10, 'may-giat078.webp ', 8, 'Máy giặt chế độ giặt GentleCare', 'Dung tích 9kg, chế độ giặt GentleCare êm ái'),
(232, 'Máy giặt Panasonic EcoClean 7kg', 3, 3, 11000000, 9900000, 10, 'may-giat079.webp ', 15, 'Máy giặt công nghệ EcoClean', 'Dung tích 7kg, công nghệ EcoClean tiết kiệm nước'),
(233, 'Máy giặt Toshiba SilentWash 6kg', 4, 3, 9000000, 8100000, 10, 'may-giat080.webp ', 20, 'Máy giặt chế độ giặt SilentWash', 'Dung tích 6kg, chế độ giặt SilentWash êm ái'),
(234, 'Máy giặt Aqua TurboWash 9kg', 5, 3, 14000000, 12600000, 10, 'may-giat081.webp ', 12, 'Máy giặt chế độ giặt TurboWash', 'Dung tích 9kg, chế độ giặt TurboWash giặt sạch nhanh chóng'),
(235, 'Máy giặt Hitachi QuickWash 8kg', 6, 3, 13000000, 11700000, 10, 'may-giat081.webp ', 18, 'Máy giặt chế độ giặt QuickWash', 'Dung tích 8kg, chế độ giặt QuickWash nhanh chóng'),
(236, 'Máy giặt Mitsubishi PowerWash 7kg', 7, 3, 12000000, 10800000, 10, 'may-giat083.webp ', 11, 'Máy giặt chế độ giặt PowerWash', 'Dung tích 7kg, chế độ giặt PowerWash giặt sâu hơn'),
(237, 'Máy giặt Sharp SilentClean 9kg', 8, 3, 14000000, 12600000, 10, 'may-giat084.webp ', 16, 'Máy giặt chế độ giặt SilentClean', 'Dung tích 9kg, chế độ giặt SilentClean êm ái'),
(238, 'Máy giặt Electrolux SteamWash 8kg', 9, 3, 13500000, 12150000, 10, 'may-giat085.webp ', 14, 'Máy giặt công nghệ SteamWash', 'Dung tích 8kg, công nghệ SteamWash diệt khuẩn'),
(239, 'Máy giặt Haier QuickClean 7kg', 10, 3, 11500000, 10350000, 10, 'may-giat086.webp ', 22, 'Máy giặt chế độ giặt QuickClean', 'Dung tích 7kg, chế độ giặt QuickClean giặt nhanh chóng'),
(240, 'Máy giặt Samsung GentleWash 8kg', 1, 3, 12000000, 10800000, 10, 'may-giat087.webp ', 10, 'Máy giặt chế độ giặt GentleWash', 'Dung tích 8kg, chế độ giặt GentleWash giữ vải mềm mại'),
(241, 'Máy giặt LG EcoWash 9kg', 2, 3, 15000000, 13500000, 10, 'may-giat088.webp ', 8, 'Máy giặt công nghệ EcoWash', 'Dung tích 9kg, công nghệ EcoWash tiết kiệm nước'),
(242, 'Máy giặt Panasonic QuickClean 7kg', 3, 3, 11000000, 9900000, 10, 'may-giat089.webp ', 15, 'Máy giặt chế độ giặt QuickClean', 'Dung tích 7kg, chế độ giặt QuickClean giặt nhanh chóng'),
(243, 'Máy giặt Toshiba TurboWash 6kg', 4, 3, 9000000, 8100000, 10, 'may-giat090.webp ', 20, 'Máy giặt chế độ giặt TurboWash', 'Dung tích 6kg, chế độ giặt TurboWash giặt sạch nhanh chóng'),
(244, 'Máy giặt Aqua PowerWash 9kg', 5, 3, 14000000, 12600000, 10, 'may-giat091.webp', 12, 'Máy giặt chế độ giặt PowerWash', 'Dung tích 9kg, chế độ giặt PowerWash giặt sâu hơn'),
(246, 'Máy giặt Mitsubishi GentleCare 7kg', 7, 3, 12000000, 10800000, 10, 'may-giat093.webp ', 11, 'Máy giặt chế độ giặt GentleCare', 'Dung tích 7kg, chế độ giặt GentleCare giữ vải mềm mại'),
(247, 'Máy giặt Sharp SilentWash 9kg', 8, 3, 14000000, 12600000, 10, 'may-giat094.webp ', 16, 'Máy giặt chế độ giặt SilentWash', 'Dung tích 9kg, chế độ giặt SilentWash êm ái'),
(248, 'Máy giặt Electrolux TurboClean 8kg', 9, 3, 13500000, 12150000, 10, 'may-giat095.webp ', 14, 'Máy giặt chế độ giặt TurboClean', 'Dung tích 8kg, chế độ giặt TurboClean giặt sạch hơn'),
(249, 'Máy giặt Haier EcoClean 7kg', 10, 3, 11500000, 10350000, 10, 'may-giat096.webp ', 22, 'Máy giặt công nghệ EcoClean', 'Dung tích 7kg, công nghệ EcoClean tiết kiệm nước'),
(250, 'Máy lạnh Samsung Inverter 1.5HP', 1, 2, 12000000, 10800000, 10, 'may-lanh67.webp', 10, 'Làm lạnh mạnh mẽ, tiết kiệm năng lượng, thiết kế thẩm mỹ', 'Công suất 1.5HP, công nghệ Inverter, thiết kế thẩm mỹ'),
(251, 'Máy lạnh LG Dual Inverter 2HP', 2, 2, 16000000, 14400000, 10, 'may-lanh68.webp', 8, 'Công nghệ Dual Inverter, làm lạnh nhanh chóng, chất liệu bền bỉ', 'Công suất 2HP, công nghệ Dual Inverter, chất liệu bền bỉ'),
(252, 'Máy lạnh Panasonic Econavi 1HP', 3, 2, 11000000, 9900000, 10, 'may-lanh69.webp', 15, 'Công nghệ Econavi tiết kiệm năng lượng, làm lạnh hiệu quả, thiết kế đẹp mắt', 'Công suất 1HP, công nghệ Econavi tiết kiệm năng lượng, thiết kế đẹp mắt'),
(253, 'Máy lạnh Toshiba Smart 1.5HP', 4, 2, 13000000, 11700000, 10, 'may-lanh70.webp', 20, 'Chế độ làm lạnh thông minh Smart, công suất ổn định, vận hành êm ái', 'Công suất 1.5HP, chế độ làm lạnh thông minh Smart, vận hành êm ái'),
(254, 'Máy lạnh Aqua Cool 2HP', 5, 2, 17000000, 15300000, 10, 'may-lanh71.webp', 12, 'Chế độ làm lạnh Cool, thiết kế hiện đại, hiệu suất làm lạnh cao', 'Công suất 2HP, chế độ làm lạnh Cool, hiệu suất làm lạnh cao'),
(256, 'Máy lạnh TurboFreeze 2HP', 1, 2, 16000000, 12000000, 25, 'may-lanh03.webp', 8, 'Máy lạnh công nghệ TurboFreeze', 'Công suất 2HP, công nghệ TurboFreeze làm lạnh nhanh chóng'),
(257, 'Máy lạnh Inverter FrostGuard 1.5HP', 2, 2, 13000000, 8450000, 35, 'may-lanh04.webp', 15, 'Máy lạnh công nghệ Inverter FrostGuard', 'Công suất 1.5HP, công nghệ Inverter FrostGuard giữ ổn định nhiệt độ'),
(258, 'Máy lạnh SmartBreeze 2.5HP', 2, 2, 18000000, 12600000, 30, 'may-lanh05.webp', 12, 'Máy lạnh công nghệ SmartBreeze', 'Công suất 2.5HP, công nghệ SmartBreeze điều chỉnh thông minh nhiệt độ'),
(259, 'Máy lạnh CoolPro 1.5HP', 3, 2, 14000000, 9100000, 35, 'may-lanh06.webp', 20, 'Máy lạnh công nghệ CoolPro', 'Công suất 1.5HP, công nghệ CoolPro làm lạnh mạnh mẽ'),
(261, 'Máy lạnh GlacierCool 2.5HP', 2, 2, 20000000, 15000000, 25, 'may-lanh08.webp', 17, 'Máy lạnh GlacierCool 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh GlacierCool'),
(262, 'Máy lạnh FreshAir 1HP', 3, 2, 14000000, 9100000, 35, 'may-lanh09.webp', 19, 'Máy lạnh FreshAir 1HP', 'Công suất 1HP, chế độ làm lạnh FreshAir'),
(263, 'Máy lạnh CoolWave 2HP', 4, 2, 18000000, 12600000, 30, 'may-lanh10.webp', 21, 'Máy lạnh CoolWave 2HP', 'Công suất 2HP, chế độ làm lạnh CoolWave'),
(264, 'Máy lạnh EcoBlast 1.5HP', 5, 2, 16000000, 12800000, 20, 'may-lanh11.webp', 23, 'Máy lạnh EcoBlast 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh EcoBlast'),
(265, 'Máy lạnh FrostBreeze 2.5HP', 6, 2, 22000000, 15400000, 30, 'may-lanh12.webp', 25, 'Máy lạnh FrostBreeze 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh FrostBreeze'),
(266, 'Máy lạnh SmartChill 1HP', 7, 2, 15000000, 11250000, 25, 'may-lanh13.webp', 27, 'Máy lạnh SmartChill 1HP', 'Công suất 1HP, chế độ làm lạnh SmartChill'),
(267, 'Máy lạnh TurboChill 2HP', 8, 2, 19000000, 12350000, 35, 'may-lanh14.webp', 29, 'Máy lạnh TurboChill 2HP', 'Công suất 2HP, chế độ làm lạnh TurboChill'),
(268, 'Máy lạnh EcoFreeze Plus 1.5HP', 9, 2, 17000000, 13600000, 20, 'may-lanh15.webp', 31, 'Máy lạnh EcoFreeze Plus 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh EcoFreeze Plus'),
(269, 'Máy lạnh PowerChill 2.5HP', 10, 2, 23000000, 16100000, 30, 'may-lanh16.webp', 33, 'Máy lạnh PowerChill 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh PowerChill'),
(270, 'Máy lạnh FrostBlast 1HP', 1, 2, 12000000, 9000000, 25, 'may-lanh17.webp', 35, 'Máy lạnh FrostBlast 1HP', 'Công suất 1HP, chế độ làm lạnh FrostBlast'),
(271, 'Máy lạnh ChillWave 2HP', 2, 2, 18000000, 11700000, 35, 'may-lanh18.webp', 37, 'Máy lạnh ChillWave 2HP', 'Công suất 2HP, chế độ làm lạnh ChillWave'),
(272, 'Máy lạnh ArcticBreeze 1.5HP', 3, 2, 14000000, 11200000, 20, 'may-lanh19.webp', 39, 'Máy lạnh ArcticBreeze 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh ArcticBreeze'),
(273, 'Máy lạnh ChillPro 2.5HP', 4, 2, 20000000, 14000000, 30, 'may-lanh20.webp', 41, 'Máy lạnh ChillPro 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh ChillPro'),
(274, 'Máy lạnh EcoChill 1HP', 5, 2, 13000000, 9750000, 25, 'may-lanh21.webp', 43, 'Máy lạnh EcoChill 1HP', 'Công suất 1HP, chế độ làm lạnh EcoChill'),
(275, 'Máy lạnh FrostGuard Plus 2HP', 6, 2, 17000000, 13600000, 20, 'may-lanh22.webp', 45, 'Máy lạnh FrostGuard Plus 2HP', 'Công suất 2HP, chế độ làm lạnh FrostGuard Plus'),
(276, 'Máy lạnh SilentFreeze 1.5HP', 7, 2, 15000000, 10500000, 30, 'may-lanh23.webp', 47, 'Máy lạnh SilentFreeze 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh SilentFreeze'),
(277, 'Máy lạnh TurboBlast 2.5HP', 8, 2, 21000000, 13650000, 35, 'may-lanh24.webp', 49, 'Máy lạnh TurboBlast 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh TurboBlast'),
(278, 'Máy lạnh ArcticFreeze 1HP', 9, 2, 13000000, 10400000, 20, 'may-lanh25.webp', 51, 'Máy lạnh ArcticFreeze 1HP', 'Công suất 1HP, chế độ làm lạnh ArcticFreeze'),
(279, 'Máy lạnh QuickChill 2HP', 10, 2, 19000000, 14250000, 25, 'may-lanh26.webp', 53, 'Máy lạnh QuickChill 2HP', 'Công suất 2HP, chế độ làm lạnh QuickChill'),
(280, 'Máy lạnh EcoBreeze 1.5HP', 1, 2, 15000000, 9750000, 35, 'may-lanh27.webp', 55, 'Máy lạnh EcoBreeze 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh EcoBreeze'),
(281, 'Máy lạnh FrostWave 2HP', 2, 2, 17000000, 13600000, 20, 'may-lanh28.webp', 57, 'Máy lạnh FrostWave 2HP', 'Công suất 2HP, chế độ làm lạnh FrostWave'),
(282, 'Máy lạnh SmartFreeze 1HP', 3, 2, 13000000, 9750000, 25, 'may-lanh29.webp', 59, 'Máy lạnh SmartFreeze 1HP', 'Công suất 1HP, chế độ làm lạnh SmartFreeze'),
(283, 'Máy lạnh GlacierBlast 2.5HP', 4, 2, 20000000, 14000000, 30, 'may-lanh30.webp', 61, 'Máy lạnh GlacierBlast 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh GlacierBlast'),
(284, 'Máy lạnh EcoBlast Plus 1.5HP', 5, 2, 16000000, 10400000, 35, 'may-lanh31.webp', 63, 'Máy lạnh EcoBlast Plus 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh EcoBlast Plus'),
(285, 'Máy lạnh PowerWave 2HP', 6, 2, 19000000, 15200000, 20, 'may-lanh32.webp', 65, 'Máy lạnh PowerWave 2HP', 'Công suất 2HP, chế độ làm lạnh PowerWave'),
(286, 'Máy lạnh FrostChill 1HP', 7, 2, 14000000, 10500000, 25, 'may-lanh33.webp', 67, 'Máy lạnh FrostChill 1HP', 'Công suất 1HP, chế độ làm lạnh FrostChill'),
(287, 'Máy lạnh ChillBlast 2HP', 8, 2, 18000000, 12600000, 30, 'may-lanh34.webp', 69, 'Máy lạnh ChillBlast 2HP', 'Công suất 2HP, chế độ làm lạnh ChillBlast'),
(288, 'Máy lạnh ArcticChill 1.5HP', 9, 2, 15000000, 9750000, 35, 'may-lanh35.webp', 71, 'Máy lạnh ArcticChill 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh ArcticChill'),
(289, 'Máy lạnh ChillPro Plus 2.5HP', 10, 2, 22000000, 17600000, 20, 'may-lanh36.webp', 73, 'Máy lạnh ChillPro Plus 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh ChillPro Plus'),
(290, 'Máy lạnh EcoCool Plus 1HP', 1, 2, 13000000, 9750000, 25, 'may-lanh37.webp', 75, 'Máy lạnh EcoCool Plus 1HP', 'Công suất 1HP, chế độ làm lạnh EcoCool Plus'),
(291, 'Máy lạnh TurboCool 2HP', 2, 2, 17000000, 11900000, 30, 'may-lanh38.webp', 77, 'Máy lạnh TurboCool 2HP', 'Công suất 2HP, chế độ làm lạnh TurboCool'),
(292, 'Máy lạnh FrostPro 1.5HP', 3, 2, 14000000, 9100000, 35, 'may-lanh39.webp', 79, 'Máy lạnh FrostPro 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh FrostPro'),
(293, 'Máy lạnh ChillWave Plus 2HP', 4, 2, 19000000, 15200000, 20, 'may-lanh40.webp', 81, 'Máy lạnh ChillWave Plus 2HP', 'Công suất 2HP, chế độ làm lạnh ChillWave Plus'),
(294, 'Máy lạnh ArcticBlast 1HP', 5, 2, 13000000, 9750000, 25, 'may-lanh41.webp', 83, 'Máy lạnh ArcticBlast 1HP', 'Công suất 1HP, chế độ làm lạnh ArcticBlast'),
(295, 'Máy lạnh GlacierChill 2.5HP', 6, 2, 20000000, 13000000, 35, 'may-lanh42.webp', 85, 'Máy lạnh GlacierChill 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh GlacierChill'),
(296, 'Máy lạnh EcoFreeze Plus 1.5HP', 7, 2, 16000000, 12800000, 20, 'may-lanh43.webp', 87, 'Máy lạnh EcoFreeze Plus 1.5HP', 'Công suất 1.5HP, chế độ làm lạnh EcoFreeze Plus'),
(297, 'Máy lạnh PowerChill 2.5HP', 8, 2, 22000000, 16500000, 25, 'may-lanh44.webp', 89, 'Máy lạnh PowerChill 2.5HP', 'Công suất 2.5HP, chế độ làm lạnh PowerChill'),
(298, 'Máy lạnh FrostBreeze 1HP', 9, 2, 12000000, 8400000, 30, 'may-lanh45.webp', 91, 'Máy lạnh FrostBreeze 1HP', 'Công suất 1HP, chế độ làm lạnh FrostBreeze'),
(299, 'Máy lạnh ChillPro 2HP', 10, 2, 19000000, 12350000, 35, 'may-lanh46.webp', 93, 'Máy lạnh ChillPro 2HP', 'Công suất 2HP, chế độ làm lạnh ChillPro'),
(300, 'Máy sấy Samsung Inverter 8kg', 1, NULL, 13000000, 11700000, 10, 'may-giat063.webp', 10, 'Sấy khô hiệu quả, nhẹ nhàng với quần áo, thiết kế hiện đại', 'Dung tích 8kg, công nghệ Inverter, thiết kế hiện đại'),
(301, 'Máy sấy LG Steam 9kg', 2, NULL, 15000000, 13500000, 10, 'may-giat050.webp', 8, 'Sấy khô bằng hơi nước, dung tích lớn, các tùy chọn sấy tiên tiến', 'Dung tích 9kg, sấy khô bằng hơi nước, các tùy chọn sấy tiên tiến'),
(302, 'Máy sấy Panasonic Eco 7kg', 3, NULL, 11000000, 9900000, 10, 'may-giat050.webp', 15, 'Vận hành tiết kiệm năng lượng, hiệu suất sấy cao, chất liệu bền bỉ', 'Dung tích 7kg, vận hành tiết kiệm năng lượng, chất liệu bền bỉ'),
(303, 'Máy sấy Toshiba QuickDry 10kg', 4, 4, 18000000, 16200000, 10, 'may-say36.webp', 20, 'Chế độ sấy khô nhanh, dung tích lớn, vận hành tiết kiệm năng lượng', 'Dung tích 10kg, chế độ sấy khô nhanh, vận hành tiết kiệm năng lượng'),
(304, 'Máy sấy Aqua TurboDry 6kg', 5, 4, 14000000, 12600000, 10, 'may-say40.webp', 12, 'Công nghệ sấy Turbo, thiết kế nhỏ gọn, giá phải chăng', 'Dung tích 6kg, công nghệ sấy Turbo, giá phải chăng'),
(308, 'Máy sấy TurboDry', 4, 3, 8500000, 6800000, 20, 'may-say36.webp', 8, 'Máy sấy công suất cao TurboDry', 'Chế độ Turbo sấy nhanh chóng trong thời gian ngắn.'),
(311, 'Máy sấy WhisperDry', 7, 3, 9500000, 6650000, 30, 'may-say39.webp', 9, 'Máy sấy WhisperDry êm ái', 'Không gây tiếng ồn khi sử dụng, phù hợp cho không gian sống nhỏ.'),
(312, 'Máy sấy QuickDry', 8, 3, 8000000, 5600000, 30, 'may-say40.webp', 11, 'Máy sấy QuickDry sấy nhanh chóng', 'Sấy quần áo một cách nhanh chóng, giúp bạn tiết kiệm thời gian.'),
(313, 'Máy sấy CompactDry', 9, 3, 7000000, 4900000, 30, 'may-say41.webp', 14, 'Máy sấy CompactDry thiết kế nhỏ gọn', 'Thiết kế nhỏ gọn, phù hợp cho các căn hộ hoặc không gian hẹp.'),
(314, 'Máy sấy SteamFresh', 10, 3, 11000000, 7700000, 30, 'may-say42.webp', 8, 'Máy sấy SteamFresh sấy và làm mới', 'Sấy và làm mới quần áo cùng một lúc, loại bỏ nếp nhăn mà không cần ủi.'),
(315, 'Máy sấy SensorDry', 11, 3, 9500000, 6650000, 30, 'may-say43.webp', 10, 'Máy sấy SensorDry điều chỉnh tự động', 'Cảm biến thông minh điều chỉnh thời gian sấy dựa trên độ ẩm của quần áo.'),
(316, 'Máy sấy OdorShield', 12, 3, 10000000, 7000000, 30, 'may-say44.webp', 9, 'Máy sấy OdorShield kháng khuẩn', 'Loại bỏ mùi khó chịu và kháng khuẩn, giữ quần áo luôn thơm tho.'),
(317, 'Máy sấy WeatherGuard', 13, 3, 10500000, 7350000, 30, 'may-say45.webp', 7, 'Máy sấy WeatherGuard điều chỉnh thông minh', 'Điều chỉnh chế độ sấy dựa trên dự báo thời tiết, đảm bảo quần áo luôn khô trong mọi điều kiện.'),
(318, 'Máy sấy PowerDry', 14, 3, 9500000, 6650000, 30, 'may-say46.webp', 12, 'Máy sấy PowerDry công suất cao', 'Công suất mạnh mẽ, sấy nhanh chóng mà không làm hỏng quần áo.'),
(319, 'Máy sấy EcoFresh', 15, 3, 8500000, 5950000, 30, 'may-say47.webp', 11, 'Máy sấy EcoFresh tiết kiệm năng lượng', 'Sấy bằng không khí sinh học, không gây hại cho sức khỏe và môi trường.'),
(320, 'Máy sấy CleanAir', 16, 3, 10000000, 7000000, 30, 'may-say48.webp', 9, 'Máy sấy CleanAir lọc không khí', 'Lọc bụi và vi khuẩn trong quá trình sấy, giữ không khí trong lành cho gia đình.'),
(321, 'Máy sấy GentleDry', 17, 3, 9000000, 6300000, 30, 'may-say49.webp', 13, 'Máy sấy GentleDry cho vải mềm mại', 'Chế độ sấy nhẹ nhàng, bảo vệ sợi vải nhạy cảm.'),
(322, 'Máy sấy SunDry', 18, 3, 11000000, 7700000, 30, 'may-say50.webp', 8, 'Máy sấy SunDry sử dụng năng lượng mặt trời', 'Sử dụng ánh nắng mặt trời để sấy khô quần áo, tiết kiệm năng lượng.'),
(323, 'Máy sấy FreshBreeze', 19, 3, 9500000, 6650000, 30, 'may-say51.webp', 10, 'Máy sấy FreshBreeze hương thơm dễ chịu', 'Cung cấp không khí tươi mát và hương thơm dễ chịu trong quá trình sấy.'),
(324, 'Máy sấy EasyFold', 20, 3, 7500000, 5250000, 30, 'may-say52.webp', 12, 'Máy sấy EasyFold dễ gấp gọn', 'Thiết kế dễ dàng gấp gọn sau khi sử dụng, tiết kiệm không gian lưu trữ.'),
(365, 'Máy lọc nước gia đình RO Clean', 1, 5, 15000000, 12000000, 20, 'may-loc-nuoc071.webp', 20, 'Máy lọc nước gia đình RO Clean', 'Máy lọc nước gia đình với công nghệ RO Clean.'),
(366, 'Máy lọc nước di động AquaFresh', 2, 5, 10000000, 8000000, 20, 'may-loc-nuoc072.webp', 15, 'Máy lọc nước di động AquaFresh', 'Máy lọc nước di động tiện lợi AquaFresh.'),
(367, 'Máy lọc nước sạch SuperPure', 3, 5, 18000000, 14400000, 20, 'may-loc-nuoc073.webp', 18, 'Máy lọc nước sạch SuperPure', 'Máy lọc nước sạch với công nghệ SuperPure.'),
(368, 'Máy lọc nước phòng tắm FreshFlow', 4, 5, 12000000, 9600000, 20, 'may-loc-nuoc074.webp', 22, 'Máy lọc nước phòng tắm FreshFlow', 'Máy lọc nước phòng tắm FreshFlow với công nghệ hiện đại.'),
(369, 'Máy lọc nước công nghệ RO Elite', 5, 5, 20000000, 16000000, 20, 'may-loc-nuoc075.webp', 25, 'Máy lọc nước công nghệ RO Elite', 'Máy lọc nước với công nghệ RO Elite.'),
(370, 'Máy lọc nước mini CompactPure', 6, 5, 13000000, 10400000, 20, 'may-loc-nuoc076.webp', 30, 'Máy lọc nước mini CompactPure', 'Máy lọc nước mini CompactPure tiện lợi.'),
(371, 'Máy lọc nước hồ bơi AquaClear', 7, 5, 25000000, 20000000, 20, 'may-loc-nuoc077.webp', 10, 'Máy lọc nước hồ bơi AquaClear', 'Máy lọc nước dành cho hồ bơi với công nghệ AquaClear.'),
(372, 'Máy lọc nước dành cho văn phòng OfficePure', 8, 5, 17000000, 13600000, 20, 'may-loc-nuoc078.webp', 35, 'Máy lọc nước dành cho văn phòng OfficePure', 'Máy lọc nước dành cho văn phòng OfficePure với công nghệ hiện đại.'),
(373, 'Máy lọc nước khử cặn đa cấp NanoClear', 9, 5, 22000000, 17600000, 20, 'may-loc-nuoc079.webp', 28, 'Máy lọc nước khử cặn đa cấp NanoClear', 'Máy lọc nước khử cặn đa cấp NanoClear với công nghệ hiện đại.'),
(374, 'Máy lọc nước tự động SmartWater', 1, 5, 19000000, 15200000, 20, 'may-loc-nuoc080.webp', 40, 'Máy lọc nước tự động SmartWater', 'Máy lọc nước tự động SmartWater với công nghệ hiện đại.'),
(375, 'Máy lọc nước gia đình tiết kiệm năng lượng EcoPure', 2, 5, 16000000, 12800000, 20, 'may-loc-nuoc089.webp', 32, 'Máy lọc nước gia đình tiết kiệm năng lượng EcoPure', 'Máy lọc nước gia đình tiết kiệm năng lượng EcoPure với công nghệ hiện đại.'),
(376, 'Máy lọc nước siêu tiện lợi HandyClean', 2, 5, 14000000, 11200000, 20, 'may-loc-nuoc078.webp', 20, 'Máy lọc nước siêu tiện lợi HandyClean', 'Máy lọc nước siêu tiện lợi HandyClean với công nghệ hiện đại.'),
(377, 'Máy lọc nước diệt khuẩn GermGuard', 3, 5, 21000000, 16800000, 20, 'may-loc-nuoc094.webp', 25, 'Máy lọc nước diệt khuẩn GermGuard', 'Máy lọc nước diệt khuẩn GermGuard với công nghệ hiện đại.'),
(378, 'Máy lọc nước chống cặn đa năng MultiClear', 4, 5, 23000000, 18400000, 20, 'may-loc-nuoc101.webp', 30, 'Máy lọc nước chống cặn đa năng MultiClear', 'Máy lọc nước chống cặn đa năng MultiClear với công nghệ hiện đại.'),
(379, 'Máy lọc nước dạng bình trực tiếp PurePour', 5, 5, 12000000, 9600000, 20, 'may-loc-nuoc102.webp', 18, 'Máy lọc nước dạng bình trực tiếp PurePour', 'Máy lọc nước dạng bình trực tiếp PurePour với công nghệ hiện đại.'),
(380, 'Máy lọc nước lọc siêu tinh OxyPure', 6, 5, 26000000, 20800000, 20, 'may-loc-nuoc103.webp', 35, 'Máy lọc nước lọc siêu tinh OxyPure', 'Máy lọc nước lọc siêu tinh OxyPure với công nghệ hiện đại.'),
(381, 'Máy lọc nước dùng cho gia đình nhỏ MiniAqua', 7, 5, 13000000, 10400000, 20, 'may-loc-nuoc104.webp', 22, 'Máy lọc nước dùng cho gia đình nhỏ MiniAqua', 'Máy lọc nước dùng cho gia đình nhỏ MiniAqua với công nghệ hiện đại.'),
(382, 'Máy lọc nước công nghiệp HighFlow', 8, 5, 28000000, 22400000, 20, 'may-loc-nuoc105.webp', 40, 'Máy lọc nước công nghiệp HighFlow', 'Máy lọc nước công nghiệp HighFlow với công nghệ hiện đại.'),
(383, 'Máy lọc nước kiểu dáng hiện đại ModernClear', 9, 5, 17000000, 13600000, 20, 'may-loc-nuoc108.webp', 30, 'Máy lọc nước kiểu dáng hiện đại ModernClear', 'Máy lọc nước kiểu dáng hiện đại ModernClear với công nghệ hiện đại.'),
(384, 'Máy lọc nước chống ô nhiễm PolluGuard', 2, 5, 19000000, 15200000, 20, 'may-loc-nuoc070.webp', 35, 'Máy lọc nước chống ô nhiễm PolluGuard', 'Máy lọc nước chống ô nhiễm PolluGuard với công nghệ hiện đại.'),
(385, 'Máy lọc nước thông minh SmartClear', 2, 5, 21000000, 16800000, 20, 'may-loc-nuoc082.webp', 38, 'Máy lọc nước thông minh SmartClear', 'Máy lọc nước thông minh SmartClear với công nghệ hiện đại.'),
(386, 'Máy lọc nước gia đình khử mùi OdoClear', 2, 5, 15000000, 12000000, 20, 'may-loc-nuoc090.webp', 28, 'Máy lọc nước gia đình khử mùi OdoClear', 'Máy lọc nước gia đình khử mùi OdoClear với công nghệ hiện đại.'),
(387, 'Máy lọc nước diệt khuẩn UV Safe', 2, 5, 24000000, 19200000, 20, 'may-loc-nuoc091.webp', 32, 'Máy lọc nước diệt khuẩn UV Safe', 'Máy lọc nước diệt khuẩn UV Safe với công nghệ hiện đại.'),
(388, 'Máy lọc nước khử cặn dễ sử dụng EasyClear', 2, 5, 16000000, 12800000, 20, 'may-loc-nuoc092.webp', 25, 'Máy lọc nước khử cặn dễ sử dụng EasyClear', 'Máy lọc nước khử cặn dễ sử dụng EasyClear với công nghệ hiện đại.'),
(389, 'Máy lọc nước siêu tinh PureTech', 2, 5, 22000000, 17600000, 20, 'may-loc-nuoc093.webp', 35, 'Máy lọc nước siêu tinh PureTech', 'Máy lọc nước siêu tinh PureTech với công nghệ hiện đại.'),
(390, 'Máy lọc nước dành cho nhà hàng RestaurantPure', 2, 5, 29000000, 29000000, 0, 'may-loc-nuoc096.webp', 45, 'Máy lọc nước dành cho nhà hàng RestaurantPure', 'Máy lọc nước dành cho nhà hàng RestaurantPure với công nghệ hiện đại.'),
(391, 'Máy lọc nước tiện ích UtilityFlow', 7, 5, 18000000, 12600000, 30, 'may-loc-nuoc106.webp', 30, 'Máy lọc nước tiện ích UtilityFlow', 'Máy lọc nước tiện ích UtilityFlow với công nghệ hiện đại.'),
(392, 'Máy lọc nước tinh khiết CrystalClear', 8, 5, 20000000, 14000000, 30, 'may-loc-nuoc107.webp', 32, 'Máy lọc nước tinh khiết CrystalClear', 'Máy lọc nước tinh khiết CrystalClear với công nghệ hiện đại.'),
(393, 'Máy lọc nước tự động kích hoạt AutoPure', 2, 5, 17000000, 11900000, 30, 'may-loc-nuoc100.webp', 28, 'Máy lọc nước tự động kích hoạt AutoPure', 'Máy lọc nước tự động kích hoạt AutoPure với công nghệ hiện đại.'),
(394, 'Máy lọc nước tích hợp tinh chất vitamin VitaClean', 3, 5, 25000000, 17500000, 30, 'may-loc-nuoc095.webp', 38, 'Máy lọc nước tích hợp tinh chất vitamin VitaClean', 'Máy lọc nước tích hợp tinh chất vitamin VitaClean với công nghệ hiện đại.'),
(395, 'AirPure Pro', 4, 6, 2500000, 2250000, 10, 'may-loc-kk (8).webp', 15, 'Máy lọc không khí chuyên nghiệp với công nghệ HEPA.', 'Công suất: 50m2, Bộ lọc HEPA'),
(396, 'CleanAir Elite', 8, 6, 3500000, 3150000, 10, 'may-loc-kk (14).webp', 20, 'Máy lọc không khí cao cấp với bộ lọc HEPA và khả năng loại bỏ các hạt siêu nhỏ.', 'Công suất: 70m2, Bộ lọc HEPA'),
(397, 'BreatheEasy', 3, 6, 1800000, 1440000, 20, 'may-loc-kk (7).webp', 10, 'Máy lọc không khí thiết kế nhỏ gọn phù hợp cho phòng ngủ.', 'Công suất: 30m2, Thiết kế nhỏ gọn'),
(398, 'PureBreeze', 6, 6, 2000000, 1600000, 20, 'may-loc-kk (12).webp', 12, 'Máy lọc không khí có khả năng lọc sạch không khí và tạo ra không gian trong lành.', 'Công suất: 40m2, Tạo không gian trong lành'),
(399, 'AirScent', 9, 6, 2200000, 1760000, 20, 'may-loc-kk (16).webp', 18, 'Máy lọc không khí kết hợp với thiết bị phát hương thơm tự nhiên.', 'Công suất: 45m2, Phát hương thơm tự nhiên'),
(400, 'FreshLife Air', 5, 6, 2800000, 2240000, 20, 'may-loc-kk (10).webp', 22, 'Máy lọc không khí tích hợp đèn UV-C để tiêu diệt vi khuẩn và virus.', 'Công suất: 55m2, Đèn UV-C tiêu diệt vi khuẩn'),
(401, 'PureAura', 2, 6, 3000000, 2400000, 20, 'may-loc-kk (5).webp', 25, 'Máy lọc không khí với bộ lọc nước giúp tăng độ ẩm và tạo ra không gian trong lành.', 'Công suất: 60m2, Bộ lọc nước'),
(402, 'AirSense Smart', 7, 6, 3200000, 2560000, 20, 'may-loc-kk (13).webp', 28, 'Máy lọc không khí có khả năng kết nối Wi-Fi và điều khiển thông qua ứng dụng di động.', 'Công suất: 65m2, Kết nối Wi-Fi'),
(403, 'BreatheGuard', 1, NULL, 2700000, 2160000, 20, 'may-loc-nuoc074.webp', 30, 'Máy lọc không khí chuyên dụng cho người dị ứng với chức năng loại bỏ các chất gây dị ứng như lông động vật và phấn hoa.', 'Công suất: 50m2, Loại bỏ chất gây dị ứng'),
(404, 'FreshAir Pro', 10, 6, 3500000, 2800000, 20, 'may-loc-kk (18).webp', 15, 'Máy lọc không khí chuyên nghiệp với công nghệ Ionizer.', 'Công suất: 70m2, Công nghệ Ionizer'),
(405, 'AirPurify Smart', 8, 6, 3000000, 2400000, 20, 'may-loc-kk (15).webp', 20, 'Máy lọc không khí thông minh với chế độ tự động và cảm biến chất lượng không khí.', 'Công suất: 60m2, Chế độ tự động'),
(406, 'EcoAir Fresh', 5, 6, 2500000, 1750000, 30, 'may-loc-kk (11).webp', 18, 'Máy lọc không khí tiết kiệm năng lượng với công suất lớn.', 'Công suất: 50m2, Tiết kiệm năng lượng'),
(407, 'PureSense Plus', 3, 6, 2800000, 1960000, 30, 'may-loc-kk (8).webp', 22, 'Máy lọc không khí cao cấp với bộ lọc HEPA và tính năng cảm biến không khí.', 'Công suất: 55m2, Cảm biến không khí'),
(408, 'AirVita Elite', 7, 6, 3200000, 2240000, 30, 'may-loc-kk (20).webp', 25, 'Máy lọc không khí siêu tinh khiết với bộ lọc nước và tính năng ion hóa không khí.', 'Công suất: 65m2, Bộ lọc nước'),
(409, 'CleanAir Mini', 2, 6, 2000000, 1400000, 30, 'may-loc-kk (6).webp', 16, 'Máy lọc không khí nhỏ gọn phù hợp cho phòng ngủ hoặc văn phòng.', 'Công suất: 40m2, Thiết kế nhỏ gọn'),
(410, 'AirPure Compact', 9, 6, 2300000, 1840000, 20, 'may-loc-kk (17).webp', 28, 'Máy lọc không khí hiệu quả với thiết kế nhỏ gọn và tính năng tiết kiệm năng lượng.', 'Công suất: 45m2, Tiết kiệm năng lượng'),
(411, 'BreatheFresh Smart', 1, NULL, 2700000, 1890000, 30, 'may-loc-nuoc071.webp', 32, 'Máy lọc không khí thông minh có thể kết nối với hệ thống điều khiển thông qua ứng dụng di động.', 'Công suất: 54m2, Kết nối thông minh'),
(412, 'PureAir Ultra', 6, 6, 3400000, 2720000, 20, 'may-loc-kk (19).webp', 36, 'Máy lọc không khí cao cấp với bộ lọc HEPA và tính năng ion hóa không khí.', 'Công suất: 68m2, Bộ lọc HEPA'),
(413, 'EcoBreeze Plus', 4, 6, 2600000, 1820000, 30, 'may-loc-kk (9).webp', 40, 'Máy lọc không khí tiết kiệm năng lượng với công nghệ làm lạnh tiên tiến.', 'Công suất: 52m2, Tiết kiệm năng lượng'),
(414, 'Quạt điều hòa cầm tay MiniBreeze', 8, 7, 600000, 480000, 20, 'quat-may040.webp', 10, 'Quạt điều hòa cầm tay MiniBreeze', 'Có thể mang theo bất cứ nơi đâu'),
(415, 'Quạt điều hòa di động PortableCool', 6, 7, 800000, 560000, 30, 'quat-may041.webp', 15, 'Quạt điều hòa di động PortableCool', 'Dễ dàng di chuyển và sử dụng ở mọi nơi'),
(417, 'Quạt điều hòa thông minh SmartBlast', 4, 7, 1200000, 960000, 20, 'quat-may043.webp', 12, 'Quạt điều hòa thông minh SmartBlast', 'Có thể điều chỉnh từ xa thông qua ứng dụng'),
(419, 'Quạt điều hòa dạng bình trực tiếp ChillPour', 1, 7, 700000, 560000, 20, 'quat-may045.webp', 18, 'Quạt điều hòa dạng bình trực tiếp ChillPour', 'Dễ dàng sử dụng trực tiếp từ bình nước'),
(420, 'Quạt điều hòa cánh xoay TurboFlow', 5, 7, 850000, 680000, 20, 'quat-may046.webp', 14, 'Quạt điều hòa cánh xoay TurboFlow', 'Tạo luồng không khí mạnh mẽ và rộng lớn'),
(422, 'Quạt điều hòa đeo cổ NeckCooler', 7, 7, 650000, 520000, 20, 'quat-may048.webp', 17, 'Quạt điều hòa đeo cổ NeckCooler', 'Dễ dàng mang theo và sử dụng bất cứ lúc nào'),
(423, 'Quạt điều hòa cảm biến nhiệt HeatSense', 10, 7, 1100000, 880000, 20, 'quat-may049.webp', 19, 'Quạt điều hòa cảm biến nhiệt HeatSense', 'Tự động điều chỉnh theo nhiệt độ hiện tại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warranty`
--

CREATE TABLE `warranty` (
  `warranty_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Chỉ mục cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`warranty_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT cho bảng `warranty`
--
ALTER TABLE `warranty`
  MODIFY `warranty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  ADD CONSTRAINT `order_customer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_customer` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Các ràng buộc cho bảng `warranty`
--
ALTER TABLE `warranty`
  ADD CONSTRAINT `warranty_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_customer` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
