<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Layout</title>
    <link rel="stylesheet" href="style_ne.css">
    <!-- Link to Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <!-- header -->
    <div class="header">
        <div class="header_tailieu"><i class="fa-solid fa-ticket" style="color: #79c180"></i><span
                style="margin-left: 10px">Admin</span></div>
        <div class="div_tim_kiem">
            <i class="fa-solid fa-magnifying-glass"
                style="position: relative; left: 700px;top: 15px; opacity: 0.5;"></i>
            <input type="text" placeholder="Tìm kiếm" class="timkiem" id="searchInput">
        </div>

        <i class="fa-solid fa-user user"></i>

    </div>
    <div class="container">
        <div class="profile-card">
            <div class="header content">
                <img src="49ced2e29b6d4945a13be722bac54642.jpg" alt="Avatar">
                <ul style="margin-right: 10px;">

                    <a href="../../MVC_DangNhap/View/index_dangnhap.php" style="color: white;  text-decoration: none;">
                        <li style="color: white;"><i class="fa-solid fa-arrow-right-from-bracket "
                                style="margin-right: 10px;"></i>Đăng Xuất</li>
                    </a>
                </ul>
            </div>
        </div>
        <!-- filter -->
        <div class="filter-options">
            <p>Danh sách tài khoản</p>
        </div>
        <!-- document -->
        <div class="document-grid" id="documentGrid">
            <?php
            include "../Model/TrangChu_Model.php";
            $model = new TrangChu_Model();
            $users = $model->view();
            ?>

            <?php foreach ($users as $gc): ?>

                <div class="document-card">
                    <button class="button-chinhsua">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <br>
                    <button class="button-xoa">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    <form action="../Controller/TrangChu_Controller.php" method="POST">
                        <br>
                        <div class="nguoidung">
                            <div class="doc_tit"> <i class="fas fa-user fa-3x document-icon"></i>
                                <!-- Thẻ <p> chứa tên ghi chú -->
                            </div>
                            <div class="noidungnguoidung">
                                <b>tài khoản:</b>
                                <span class="title_taikhoan"><?php echo $gc['taikhoan']; ?></span>
                                <br>
                                <b>mật khẩu:</b>
                                <span class="title_matkhau"><?php echo $gc['matkhau']; ?></span>
                            </div>
                        </div>
                    </form>
                    <form action="../../MVC_TrangGhiChu/View/index.php" method="POST">
                        <input type="hidden" name="tenGhiChu" value="">
                    </form>
                </div>



            <?php endforeach; ?>
            <!-- button -->
        </div>

    </div>
    <!-- bảng tạo ghi chú -->
    <div class="Model">
        <div class="Model-content">
            <h2>Tạo Ghi Chú</h2>
            <form action="../Controller/TrangChu_Controller.php" method="POST">
                <div class="form-group">
                    <label for="name">Tài Khoản:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật Khẩu: </label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="button-group">
                    <button type="button" class="cancel-button" name="action" value="cancel">Hủy bỏ</button>
                    <button type="submit" class="submit-button" name="action" value="add">Xong</button>
                </div>
            </form>
        </div>
    </div>
    <!-- bảng chỉnh sửa tên -->
    <div class="Model-chinhsua">
        <div class="Model-content-chinhsua">
            <h2>Sửa Tên Ghi Chú</h2>
            <form action="../Controller/TrangChu_Controller.php" method="POST">
                <div class="form-group">
                    <label for="name">Tài Khoản:</label>
                    <input type="text" id="name-chinhsua" name="name-chinhsua" required>
                    <input type="hidden" name="name-chinhsua-dau" value="">
                    <label for="name" style="margin-top: 10px;">Mật Khẩu:</label>
                    <input type="text" id="matkhau-chinhsua" name="matkhau-chinhsua" required>
                    <input type="hidden" name="matkhau-chinhsua-dau" value="">
                </div>
                <div class="button-group">
                    <button type="button" class="cancel-button-chinhsua" name="action" value="cancel-chinhsua">Hủy
                        bỏ</button>
                    <button type="submit" class="submit-button-chinhsua" name="action"
                        value="add-chinhsua">Xong</button>
                </div>
            </form>
        </div>
    </div>
    <!-- bảng xác nhận xóa -->
    <div class="Model-xoa">
        <div class="Model-content-xoa">
            <h2>Xóa Ghi Chú ?</h2>
            <form action="../Controller/TrangChu_Controller.php" method="POST">
                <div class="button-group">
                    <input type="hidden" name="ten_de_xoa" value="">
                    <button type="button" class="cancel-button-xoa" name="action" value="cancel-xoa">Hủy
                        bỏ</button>
                    <button type="submit" class="submit-button-xoa" name="action" value="confirm-xoa">Xác
                        Nhận</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Nút user -->

    <!-- input ẩn gửi tên ghi chú đến Trang ghi chú -->
    <!-- nút thêm ghi chú -->
    <div class="add-button" id="addButton">
        <i class="fas fa-plus"></i>
    </div>

    <?php
    // Kiểm tra xem có lỗi hay không từ query string
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<script type="text/javascript">';
        echo 'alert("Tài khoản đã tồn tại!");';
        echo 'window.history.replaceState(null, null, window.location.pathname);';
        echo '</script>';
    }
    ?>

    <script src="script_ne.js"></script>
</body>

</html>