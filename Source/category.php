<?php
// Đọc cơ sở dữ liệu
$pdo = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
$pdo->query("set names 'utf8'");

// Truy vấn danh sách category
$sql_ds_category = "SELECT * FROM category";
$ds_category = $pdo->query($sql_ds_category);
?>