<?php
$servername = "localhost"; // Hoặc IP của máy chủ MySQL
$username = "root"; // Tài khoản MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "se07102_sdlc"; // Tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
