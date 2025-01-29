<?php
$servername = "localhost";
$username = "root"; // Thay đổi với tên người dùng của bạn
$password = ""; // Thay đổi với mật khẩu của bạn
$dbname = "your_database_name"; // Thay đổi với tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
