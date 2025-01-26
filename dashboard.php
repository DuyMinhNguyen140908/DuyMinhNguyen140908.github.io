<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Nếu chưa đăng nhập, chuyển hướng về trang login
    exit();
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .welcome-message {
            font-size: 18px;
            color: #333;
            margin-top: 20px;
        }
        .logout {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background-color: red;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .logout:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Chào mừng đến với trang chủ</h2>
    <div class="welcome-message">
        <p>Chào mừng, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p>Bạn đã đăng nhập thành công.</p>
    </div>
    <form action="logout.php" method="POST">
        <input type="submit" value="Đăng xuất" class="logout">
    </form>
</div>

</body>
</html>
