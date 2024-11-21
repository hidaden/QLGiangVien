<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- Link to Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="phone-preview">
            <img src="d62283a1a8a96c2d6886126ae2e45dea.jpg" alt="Instagram Preview">
        </div>

        <div class="login-form">
            <h1>Note</h1>
            <form action="../Controller/DangKi_Controller.php" method="POST">
                <input type="text" placeholder="Số điện thoại, tên người dùng hoặc email" name="taikhoan" required>
                <input type="password" placeholder="Mật khẩu" name="matkhau" required>
                <input type="password" placeholder="Nhập lại mật khẩu" name="nhaplai_matkhau" required>
                <button type="submit" name="action" value="dangki">Đăng Kí</button>
                <div class="or">
                </div>
            </form>
        </div>
    </div>
    <?php
    // Kiểm tra xem có lỗi hay không từ query string
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<script type="text/javascript">';
        echo 'alert("Mật khẩu nhập lại không trùng khớp!");';
        echo 'window.history.replaceState(null, null, window.location.pathname);';
        echo '</script>';
    }
    if (isset($_GET['error']) && $_GET['error'] == 2) {
        echo '<script type="text/javascript">';
        echo 'alert("Tài khoản đã tồn tại!");';
        echo 'window.history.replaceState(null, null, window.location.pathname);';
        echo '</script>';
    }
    ?>
</body>

</html>