<?php
include_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $category_code = $_POST['category_code'];
    $description = $_POST['description'];
    $starting_price = $_POST['starting_price'];
    // $current_price = $_POST['current_price'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];

    $stmt = $conn->prepare("UPDATE products SET 
                            product_name = :product_name, 
                            category_code = :category_code, 
                            description = :description, 
                            starting_price = :starting_price, 
                            -- current_price = :current_price, 
                            start_datetime = :start_datetime, 
                            end_datetime = :end_datetime 
                            WHERE product_code = :product_code");
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':category_code', $category_code);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':starting_price', $starting_price);
    // $stmt->bindParam(':current_price', $current_price);
    $stmt->bindParam(':start_datetime', $start_datetime);
    $stmt->bindParam(':end_datetime', $end_datetime);
    $stmt->bindParam(':product_code', $product_code);
    if ($stmt->execute()) {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
}
