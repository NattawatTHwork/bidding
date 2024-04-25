<?php
session_start();

include("../../connect/connect.php");

// รับค่าจากฟอร์มเข้าสู่ระบบ
$email = $_POST['email'];
$admin_password = $_POST['admin_password'];

// ค้นหาผู้ใช้จากฐานข้อมูลโดยใช้อีเมล
$stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin) {
    // ตรวจสอบรหัสผ่าน
    if (password_verify($admin_password, $admin['admin_password'])) {
        // บันทึก session
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['admin_code'] = $admin['admin_code'];
        $_SESSION['firstname'] = $admin['firstname'];
        $_SESSION['lastname'] = $admin['lastname'];
        $_SESSION['email'] = $admin['email'];

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
