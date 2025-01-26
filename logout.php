<?php
session_start();

// Xóa session và chuyển hướng về trang login
session_unset();
session_destroy();

header("Location: login.php"); // Quay lại trang đăng nhập
exit();
?>
