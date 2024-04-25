<?php
include_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_code = $_POST['category_code'];
    $category_name = $_POST['category_name'];

    $stmt = $conn->prepare("UPDATE categories SET category_name = :category_name WHERE category_code = :category_code");
    $stmt->bindParam(':category_name', $category_name);
    $stmt->bindParam(':category_code', $category_code);
    if ($stmt->execute()) {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
}
