<?php
include "../Model/tgc_model.php";
$model = new tgc_model();
$users = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "save") {
        $vanban = isset($_POST['editorContent']) ? $_POST['editorContent'] : "";
        $ten = isset($_POST['spanContent']) ? $_POST['spanContent'] : "";

        $model->save($vanban, $ten);


        header("Location: ../View/index.php?ten=" . urlencode($ten));
        exit();
    }

}
$model->close();

?>