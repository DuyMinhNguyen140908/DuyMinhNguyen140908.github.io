<?php
session_start();

// Xóa session và chuyển hướng về trang đăng nhập
session_unset();
session_destroy();

header("Location: login.html"); // Quay lại trang đăng nhập
exit();
?>
