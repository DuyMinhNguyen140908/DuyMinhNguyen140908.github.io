<?php
$host = "localhost";  // Địa chỉ của MySQL, mặc định là localhost
$username = "root";   // Tên đăng nhập MySQL, mặc định là root
$password = "";       // Mật khẩu MySQL, mặc định là trống
$dbname = "users"; // Thay bằng tên cơ sở dữ liệu bạn đã tạo trong MySQL

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
