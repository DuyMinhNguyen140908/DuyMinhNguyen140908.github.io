<?php
session_start();
require_once '../api/db_connect.php';  // Đảm bảo đường dẫn đúng đến db_connect.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu có khớp hay không
    if ($password !== $confirm_password) {
        echo "Mật khẩu không khớp!";
        exit();
    }

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra kết nối cơ sở dữ liệu
    if (!$conn) {
        die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    // Sử dụng prepared statement để tránh SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password); // "ss" là kiểu dữ liệu của các tham số (string)

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        echo "Đăng ký thành công!";
        // Sau khi đăng ký thành công, chuyển hướng đến trang đăng nhập
        header("Location: login.php");
        exit();
    } else {
        echo "Tài khoản đã tồn tại!";
    }

    // Đóng câu lệnh và kết nối
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        .container { width: 400px; margin: 100px auto; padding: 30px; background-color: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; font-size: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        .form-group input { width: 100%; padding: 12px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; }
        .form-group input[type="submit"] { background-color: #4CAF50; color: white; cursor: pointer; border: none; padding: 12px; font-size: 16px; border-radius: 5px; }
        .form-group input[type="submit"]:hover { background-color: #45a049; }
        .switch-link { text-align: center; margin-top: 20px; }
        .switch-link a { color: #4CAF50; text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <h2>Đăng ký tài khoản</h2>
    <form action="signup.php" method="POST">
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Đăng ký">
        </div>
    </form>
    <div class="switch-link">
        <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
    </div>
</div>

</body>
</html>
