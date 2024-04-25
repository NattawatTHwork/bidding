<?php
session_start();

include("../connect/connect.php");

// รับค่าจากฟอร์มเข้าสู่ระบบ
$email = $_POST['email'];
$user_password = $_POST['user_password'];

// ค้นหาผู้ใช้จากฐานข้อมูลโดยใช้อีเมล
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // ตรวจสอบรหัสผ่าน
    if (password_verify($user_password, $user['user_password'])) {
        // บันทึก session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_code'] = $user['user_code'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];

        $response = array(
            'status' => 'success',
            'message' => 'เข้าสู่ระบบสำเร็จ'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'รหัสผ่านไม่ถูกต้อง'
        );
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'ไม่พบบัญชีผู้ใช้'
    );
}

echo json_encode($response);
?>
