<?php
include_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];

    $stmt = $conn->query("SELECT category_code FROM categories ORDER BY category_code DESC LIMIT 1");
    $last = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($last) {
        $last_code = $last['category_code'];
        $last_number = (int) substr($last_code, 2);
        $new_number = $last_number + 1;
        $new_code = 'CA' . str_pad($new_number, 6, '0', STR_PAD_LEFT);
    } else {
        $new_code = 'CA000001';
    }

    $stmt = $conn->prepare("INSERT INTO categories (category_code, category_name) VALUES (:category_code, :category_name)");
    $stmt->bindParam(':category_code', $new_code);
    $stmt->bindParam(':category_name', $category_name);
    if ($stmt->execute()) {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
}
