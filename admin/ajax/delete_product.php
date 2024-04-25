<?php
include_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST['product_code'];
    $is_deleted = 1;

    $stmt = $conn->prepare("UPDATE products SET is_deleted = :is_deleted WHERE product_code = :product_code");
    $stmt->bindParam(':is_deleted', $is_deleted);
    $stmt->bindParam(':product_code', $product_code);
    if ($stmt->execute()) {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
}
