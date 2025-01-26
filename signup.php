<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu có khớp hay không
    if ($password !== $confirm_password) {
        echo "Mật khẩu không khớp!";
        exit();
    }

    // Bảo mật mật khẩu bằng cách mã hóa
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Thêm vào cơ sở dữ liệu
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Đăng ký thành công!";
        header("Location: login.html"); // Chuyển hướng về trang login
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
