<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin người dùng từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Sử dụng 's' vì username là chuỗi
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem người dùng có tồn tại hay không
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($password, $row['password'])) {
            // Đăng nhập thành công, lưu thông tin vào session
            $_SESSION['username'] = $username;
            // Chuyển hướng đến trang dashboard
            header("Location: dashboard.php");
            exit(); // Dừng lại sau khi chuyển hướng
        } else {
            echo "Sai mật khẩu!";
        }
    } else {
        echo "Tài khoản không tồn tại!";
    }

    $stmt->close(); // Đóng statement
    $conn->close(); // Đóng kết nối
}
?>
