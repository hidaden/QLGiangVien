<?php
include "../Model/DangKi_Model.php";
$model = new Dangki_Model();
$users = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "dangki") {
        $taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : "";
        $matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : "";
        $matkhau_mahoa = password_hash($matkhau, PASSWORD_DEFAULT);
        $nhaplai_mk = isset($_POST['nhaplai_matkhau']) ? $_POST['nhaplai_matkhau'] : "";
        $users = $model->view();
        if ($matkhau != $nhaplai_mk) {
            header("Location:../View/index_dangki.php?error=1");
            exit(); // Dừng thực thi
        } elseif ($matkhau == $nhaplai_mk) {
            foreach ($users as $tk) {
                if ($taikhoan == $tk['taikhoan']) {
                    header("Location:../View/index_dangki.php?error=2");
                    exit(); // Dừng thực thi
                }
            }
        }

        $model->add($taikhoan, $matkhau_mahoa);
        header("Location:../../MVC_DangNhap/View/index_dangnhap.php");
        exit(); // Dừng thực thi
    }
}
$model->close();
?>