<?php
include "../Model/TrangChu_Model.php";
$model = new TrangChu_Model();
$users = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "add") {
        $tenGC = isset($_POST['name']) ? $_POST['name'] : "";
        $matkhau = isset($_POST['password']) ? $_POST['password'] : "";
        $users = $model->view();
        $exists = false;
        foreach ($users as $gc) {
            // So sánh tên ghi chú
            if ($tenGC === $gc['tenGC']) { // Sửa ở đây
                $exists = true; // Đánh dấu là tồn tại
                break; // Thoát khỏi vòng lặp
            }
        }

        if ($exists) {
            header("Location:../View/index.php?error=1");
            exit(); // Dừng thực thi
        }
        $model->add($tenGC, "");
        header("Location:../View/index.php");
        exit();
    } elseif ($action == "view") {
        $users = $model->view();
    } elseif ($action == "confirm-xoa") {
        $tenGC = isset($_POST['ten_de_xoa']) ? $_POST['ten_de_xoa'] : "";
        $users = $model->view();
        foreach ($users as $gc) {
            if ($tenGC === $gc['tenGC']) {
                $model->delete($tenGC);
                header("Location:../View/index.php");
                exit();
            }

        }
    } elseif ($action == "add-chinhsua") {
        $tenchinhsuaFirst = isset($_POST['name-chinhsua-dau']) ? $_POST['name-chinhsua-dau'] : "";
        $tenchinhsuaAfter = isset($_POST['name-chinhsua']) ? $_POST['name-chinhsua'] : "";
        $model->edit($tenchinhsuaFirst, $tenchinhsuaAfter);
        header("Location:../View/index.php");
        exit();
    } elseif ($action == "doimatkhau") {
        $taikhoan = isset($_POST['username']) ? $_POST['username'] : "";
        $matkhau = isset($_POST['password']) ? $_POST['password'] : "";
        $matkhaumoi = isset($_POST['new-password']) ? $_POST['new-password'] : "";
        $matkhaumoi_mahoa = password_hash($matkhaumoi, PASSWORD_DEFAULT);
        $users = $model->viewNguoiDung();
        foreach ($users as $gc) {
            if ($taikhoan == $gc['taikhoan'] && password_verify($matkhau, $gc['matkhau'])) { // Sửa ở đây
                $model->doiMatKhau($taikhoan, $matkhaumoi_mahoa);
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