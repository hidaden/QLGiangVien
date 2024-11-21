<?php
include "../Model/TrangChu_Model.php";
$model = new TrangChu_Model();
$users = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "add") {
        $taikhoan = isset($_POST['name']) ? $_POST['name'] : "";
        $matkhau = isset($_POST['password']) ? $_POST['password'] : "";
        $users = $model->view();
        $exists = false;
        foreach ($users as $gc) {
            // So sánh tên ghi chú
            if ($taikhoan === $gc['taikhoan']) { // Sửa ở đây
                $exists = true; // Đánh dấu là tồn tại
                break; // Thoát khỏi vòng lặp
            }
        }

        if ($exists) {
            header("Location:../View/index.php?error=1");
            exit(); // Dừng thực thi
        }
        $model->add($taikhoan, $matkhau);
        header("Location:../View/index.php");
        exit();
    } elseif ($action == "view") {
        $users = $model->view();
    } elseif ($action == "confirm-xoa") {
        $taikhoan = isset($_POST['ten_de_xoa']) ? $_POST['ten_de_xoa'] : "";
        $users = $model->view();
        foreach ($users as $gc) {
            if ($taikhoan === $gc['taikhoan']) {
                $model->delete($taikhoan);
                header("Location:../View/index.php");
                exit();
            }

        }
    } elseif ($action == "add-chinhsua") {
        $tenchinhsuaFirst = isset($_POST['name-chinhsua-dau']) ? $_POST['name-chinhsua-dau'] : "";
        $tenchinhsuaAfter = isset($_POST['name-chinhsua']) ? $_POST['name-chinhsua'] : "";
        $mkchinhsuaFirst = isset($_POST['matkhau-chinhsua-dau']) ? $_POST['matkhau-chinhsua-dau'] : "";
        $mkchinhsuaAfter = isset($_POST['matkhau-chinhsua']) ? $_POST['matkhau-chinhsua'] : "";
        $model->edit_taikhoan($tenchinhsuaFirst, $tenchinhsuaAfter);
        $model->edit_matkhau($mkchinhsuaFirst, $mkchinhsuaAfter);
        header("Location:../View/index.php");
        exit();
    } elseif ($action == "doimatkhau") {
        $taikhoan = isset($_POST['username']) ? $_POST['username'] : "";
        $matkhau = isset($_POST['password']) ? $_POST['password'] : "";
        $matkhaumoi = isset($_POST['new-password']) ? $_POST['new-password'] : "";
        $users = $model->viewNguoiDung();
        foreach ($users as $gc) {
            if ($taikhoan == $gc['taikhoan'] && $matkhau == $gc['matkhau']) { // Sửa ở đây
                $model->doiMatKhau($taikhoan, $matkhaumoi);
                header("Location:../View/index.php");
                exit(); // Dừng thực thi
            }
        }
        header("Location:../View/doimatkhau.php?error=1");
        exit(); // Dừng thực thi



    }

}
$model->close();
?>