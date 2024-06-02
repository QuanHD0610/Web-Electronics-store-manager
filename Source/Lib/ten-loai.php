<?php
    $pdo1 = new PDO("mysql:host=localhost;dbname=ql_cuahangdienmay", "root", "");
    $pdo1->query("set names 'utf8'");
    
    $sql_category = "SELECT * FROM category";
    $ds_category = $pdo1->query($sql_category);
    $pdo1=null;   
?>