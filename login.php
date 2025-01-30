<?php
session_start();
require_once '../api/db_connect.php';  // Đảm bảo đường dẫn đúng đến db_connect.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra kết nối cơ sở dữ liệu
    
    // Sử dụng prepared statement để tránh SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);  // "s" là kiểu dữ liệu của tham số (string)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Người dùng tồn tại, kiểm tra mật khẩu
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Mật khẩu đúng, đăng nhập thành công
            $_SESSION['username'] = $username;
            header("Location:https://duyminhnguyen140908.github.io/");  // Chuyển hướng đến trang web của bạn
            exit();
        } else {
            echo "Mật khẩu sai!";
        }
    } else {
        echo "Tài khoản không tồn tại!";
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
    <title>Đăng nhập</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        .container { width: 400px; margin: 100px auto; padding: 30px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
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
    <h2>Đăng nhập</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Đăng nhập">
        </div>
    </form>
    <div class="switch-link">
        <p>Chưa có tài khoản? <a href="signup.html">Đăng ký</a></p>
    </div>
</div>

</body>
</html>
