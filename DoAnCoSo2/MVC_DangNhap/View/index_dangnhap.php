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
            <form action="../Controller/DangNhap_Controller.php" method="POST">
                <input type="text" placeholder="Số điện thoại, tên người dùng hoặc email" name="taikhoan" id="taikhoan"
                    required>
                <input type="password" placeholder="Mật khẩu" name="matkhau" required>
                <button type="submit" name="action" value="dangnhap">Đăng Nhập</button>
                <div class="or">
                    <div class="line"></div>
                    <span>HOẶC</span>
                    <div class="line"></div>
                </div>
            </form>

            <div class="sign-up">
                <span>Bạn chưa có tài khoản? <a href="../../MVC_DangKi/View/index_dangki.php" style="text-decoration: none;color: #79c180;">Đăng kí</a></span>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<script type="text/javascript">';
        echo 'alert("Tài khoản hoặc mật khẩu không đúng!");';
        echo 'window.history.replaceState(null, null, window.location.pathname);';
        echo '</script>';
    }
    ?>

    <script src="script_dangnhap.js"></script>
</body>

</html>