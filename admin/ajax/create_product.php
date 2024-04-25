<?php
include_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $product_name = $_POST['product_name'];
    $category_code = $_POST['category_code'];
    $description = $_POST['description'];
    $starting_price = $_POST['starting_price'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];

    $stmt = $conn->query("SELECT product_code FROM products ORDER BY product_code DESC LIMIT 1");
    $last = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($last) {
        $last_code = $last['product_code'];
        $last_number = (int) substr($last_code, 2);
        $new_number = $last_number + 1;
        $new_code = 'PD' . str_pad($new_number, 6, '0', STR_PAD_LEFT);
    } else {
        $new_code = 'PD000001';
    }

    // เพิ่มสินค้าใหม่ลงในฐานข้อมูล
    $stmt = $conn->prepare("INSERT INTO products (product_code, product_name, category_code, description, starting_price, start_datetime, end_datetime) 
                            VALUES (:product_code, :product_name, :category_code, :description, :starting_price, :start_datetime, :end_datetime)");
    $stmt->bindParam(':product_code', $new_code);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':category_code', $category_code);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':starting_price', $starting_price);
    $stmt->bindParam(':start_datetime', $start_datetime);
    $stmt->bindParam(':end_datetime', $end_datetime);

    if ($stmt->execute()) {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
}
