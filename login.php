<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($password, $row['password'])) {
            // Đăng nhập thành công
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Chuyển hướng đến trang dashboard
        } else {
            echo "Sai mật khẩu!";
        }
    } else {
        echo "Tài khoản không tồn tại!";
    }

    $conn->close();
}
?>
