<?php
$servername = "localhost"; // เชื่อมต่อกับ MySQL ที่อยู่บน localhost
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน MySQL
$dbname = "bidding"; // ชื่อฐานข้อมูลที่คุณต้องการใช้

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // เซ็ต PDO เป็นการเก็บค่า error เมื่อเกิดข้อผิดพลาด
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาดในการเชื่อมต่อ: " . $e->getMessage();
}
?>
