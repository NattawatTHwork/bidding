<?php
include_once '../../connect/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_code = $_POST['category_code'];
    $is_deleted = 1;

    $stmt = $conn->prepare("UPDATE categories SET is_deleted = :is_deleted WHERE category_code = :category_code");
    $stmt->bindParam(':is_deleted', $is_deleted);
    $stmt->bindParam(':category_code', $category_code);
    if ($stmt->execute()) {
        $response = array('status' => 'success');
        echo json_encode($response);
    }
}
