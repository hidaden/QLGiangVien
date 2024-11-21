<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .change-password-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            padding: 20px;
            padding-right: 40px;
        }

        .change-password-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .submit-button {
            width: 107%;
            padding: 10px;
            background-color: #79c180;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #67a96f;
        }
    </style>
</head>

<body>
    <div class="change-password-container">
        <h2>Đổi Mật Khẩu</h2>
        <form action="../Controller/TrangChu_Controller.php" method="POST">
            <div class="form-group">
                <label for="username">Tài khoản:</label>
                <input type="text" id="username" name="username" placeholder="Nhập tài khoản" required>
            </div>
            <div class="form-group">
                <label for="current-password">Mật khẩu hiện tại:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu hiện tại" required>
            </div>
            <div class="form-group">
                <label for="new-password">Mật khẩu mới:</label>
                <input type="password" id="new-password" name="new-password" placeholder="Nhập mật khẩu mới" required>
            </div>
            <button type="submit" class="submit-button" name="action" value="doimatkhau">Xác nhận</button>
        </form>
    </div>
    <?php
    // Kiểm tra xem có lỗi hay không từ query string
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<script type="text/javascript">';
        echo 'alert("Tài khoản hoặc mật khẩu không đúng!");';
        echo 'window.history.replaceState(null, null, window.location.pathname);';
        echo '</script>';
    }
    ?>
</body>

</html>