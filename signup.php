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

    // Kiểm tra tên người dùng đã tồn tại chưa
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Tên đăng nhập đã tồn tại!";
        exit();
    }

    // Thêm vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();

    // Đăng ký thành công, chuyển hướng về trang đăng nhập
    header("Location: login.html");
    exit();
}

$conn->close();
?>
