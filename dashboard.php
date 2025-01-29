<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

echo "Chào mừng bạn, " . $_SESSION['username'] . "!";
?>

<!-- Nội dung trang chủ cho người dùng đã đăng nhập -->
<a href="logout.php">Đăng xuất</a>
