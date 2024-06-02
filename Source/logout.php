<?php
// Bắt đầu session

session_start();

// Hủy session
session_unset();
session_destroy();

// Chuyển hướng người dùng về trang chính hoặc trang đăng nhập
header("Location: index.php"); // Thay đổi index.php thành trang chính của bạn
exit();
?>
