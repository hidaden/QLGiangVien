<?php
include "../Model/DangNhap_Model.php";
$model = new DangNhap_Model();
$users = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "dangnhap") {
        $taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : "";
        $matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : "";
        $users = $model->view();
        $count = 0;
        if ($taikhoan == 'admin' && $matkhau == '1') {
            header("Location:../../MVC_Admin/View/index.php");
            exit(); // Dừng thực thi
        } else {

            foreach ($users as $u) {
                if ($taikhoan == $u['taikhoan'] && password_verify($matkhau, $u['matkhau'])) {
                    header("Location:../../MVC_TrangChu/View/index.php");
                    $count = $count + 1;
                    exit(); // Dừng thực thi

                }
            }
            if ($count == 0) {
                header("Location:../View/index_dangnhap.php?error=1");
                exit(); // Dừng thực thi
            }
        }
    }
}
$model->close();
?>