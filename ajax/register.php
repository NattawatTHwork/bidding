<?php
session_start();

include("../connect/connect.php");

// รับค่าจากฟอร์มลงทะเบียน
$email = $_POST['email'];
$user_password = $_POST['user_password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone_number = $_POST['phone_number'];
$user_address = $_POST['user_address'];

// ตรวจสอบว่ามีอีเมลนี้ในฐานข้อมูลแล้วหรือไม่
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // ถ้ามีอีเมลนี้ในฐานข้อมูลแล้ว
    $response = array(
        'status' => 'error',
        'message' => 'อีเมลนี้มีอยู่ในระบบแล้ว'
    );
} else {
    // ตรวจสอบ user_code ล่าสุดในฐานข้อมูล
    $stmt = $conn->query("SELECT user_code FROM users ORDER BY user_code DESC LIMIT 1");
    $last_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($last_user) {
        // หากมี user_code ล่าสุดในฐานข้อมูล
        $last_user_code = $last_user['user_code'];
        // แยกตัวเลขจาก user_code ล่าสุด
        $last_number = (int) substr($last_user_code, 1);
        // กำหนด user_code ใหม่โดยเพิ่มตัวเลขไปอีก 1
        $new_number = $last_number + 1;
        $new_user_code = 'U' . str_pad($new_number, 6, '0', STR_PAD_LEFT);
    } else {
        // หากไม่มีข้อมูลในฐานข้อมูลเลยให้เริ่มที่ U000001
        $new_user_code = 'U000001';
    }

    // ถ้ายังไม่มีอีเมลนี้ในฐานข้อมูล
    // เข้ารหัสรหัสผ่านก่อนที่จะบันทึกลงในฐานข้อมูล
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // เพิ่มข้อมูลผู้ใช้ใหม่ลงในฐานข้อมูล
    $stmt = $conn->prepare("INSERT INTO users (user_code, email, user_password, firstname, lastname, phone_number, user_address) VALUES (:user_code, :email, :user_password, :firstname, :lastname, :phone_number, :user_address)");
    $stmt->bindParam(':user_code', $new_user_code);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':user_password', $hashed_password);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':user_address', $user_address);
    $stmt->execute();
    
    $response = array(
        'status' => 'success',
        'message' => 'ลงทะเบียนสำเร็จ'
    );
}

echo json_encode($response);
