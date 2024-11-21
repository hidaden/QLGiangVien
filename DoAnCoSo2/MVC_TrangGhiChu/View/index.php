<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Layout</title>
    <link rel="stylesheet" href="style_nee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>


    </script>
</head>

<body>
    <div class="header">
        <a href="../../MVC_TrangChu/View/index.php"  style="text-decoration: none; color: black;">
            <div class="header_tailieu"><i class="fas fa-folder" style="color: #79c180"></i><span
                    style="margin-left: 10px">Tài liệu</span></div>
        </a>
    </div>
    <div style="margin-top: -30px;">
        <div class="toolbar_to">
            <div class="toolbar_nho">
                <button onclick="applyStyle('bold')" title="In đậm"><i class="fas fa-bold"></i></button>
                <button onclick="applyStyle('italic')" title="In nghiêng"><i class="fas fa-italic"></i></button>
                <button onclick="applyStyle('underline')" title="Gạch chân"><i class="fas fa-underline"></i></button>
                <button onclick="applyStyle('strikethrough')" title="Gạch ngang"><i
                        class="fas fa-strikethrough"></i></button>
                <div class="line"></div>
                <select onchange="changeFont(this.value)" title="Thay đổi font chữ">
                    <option value="Arial">Arial</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Garamond">Garamond</option>
                    <option value="Palatino">Palatino</option>
                    <option value="Helvetica">Helvetica</option>
                    <option value="Tahoma">Tahoma</option>
                    <option value="Trebuchet MS">Trebuchet MS</option>
                    <option value="Lucida Console">Lucida Console</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Consolas">Consolas</option>
                    <option value="Comic Sans MS">Comic Sans MS</option>
                    <option value="Brush Script MT">Brush Script MT</option>
                    <option value="Dancing Script">Dancing Script</option>
                    <option value="Impact">Impact</option>
                    <option value="Papyrus">Papyrus</option>
                </select>
                <div class="line"></div>
                <select onchange="changeFontSize(this.value)" title="Thay đổi kích thước chữ">
                    <option value="8px">8</option>
                    <option value="9px">9</option>
                    <option value="10px">10</option>
                    <option value="11px">11</option>
                    <option value="12px">12</option>
                    <option value="14px">14</option>
                    <option value="16px">16</option>
                    <option value="18px">18</option>
                    <option value="24px">24</option>
                    <option value="36px">36</option>
                    <option value="48px">48</option>
                    <option value="60px">60</option>
                    <option value="72px">72</option>
                    <option value="90px">90</option>
                </select>
                <div class="line"></div>
                <input type="color" onchange="changeColor(this.value)" title="Thay đổi màu chữ">
                <input type="color" id="highlightColor" onchange="highlightText(this.value)" title="Đánh dấu màu nền">
                <div class="line"></div>
                <button onclick="alignText('left')" title="Căn trái"><i class="fas fa-align-left"></i></button>
                <button onclick="alignText('center')" title="Căn giữa"><i class="fas fa-align-center"></i></button>
                <button onclick="alignText('right')" title="Căn phải"><i class="fas fa-align-right"></i></button>
                <button onclick="alignText('justify')" title="Căn đều"><i class="fas fa-align-justify"></i></button>
                <div class="line"></div>
                <button onclick="insertList('ordered')" title="Danh sách có thứ tự"><i
                        class="fas fa-list-ol"></i></button>
                <button onclick="insertList('unordered')" title="Danh sách không thứ tự"><i
                        class="fas fa-list-ul"></i></button>
                <div class="line"></div>
                <!-- Add image button and file input -->
                <!-- Add this button in your toolbar_nho div -->
                <button onclick="document.getElementById('imageInput').click()" title="Chèn hình ảnh">
                    <i class="fas fa-image"></i>
                </button>
                <input type="file" id="imageInput" accept="image/*" style="display:none" onchange="insertImage(event)">
                <button onclick="resizeSelectedImage('increase')" title="Tăng kích thước hình ảnh"><i
                        class="fas fa-expand"></i></button>
                <button onclick="resizeSelectedImage('decrease')" title="Giảm kích thước hình ảnh"><i
                        class="fas fa-compress"></i></button>


                <div class="line"></div>
                <form id="editorForm" action="../Controller/tgc_controller.php" method="post" onsubmit="saveContent()">
                    <input type="hidden" name="editorContent" id="editorContent">
                    <input type="hidden" name="spanContent" id="spanContent">

                    <button type="submit" name="action" value="save" title="Lưu ghi chú">Lưu</button>
                    <span id="spanElement" title="Tên ghi chú" style="display: none;"><?php
                    $vanban = isset($_POST['tenGhiChu']) ? $_POST['tenGhiChu'] : "";
                    if (isset($vanban) && !empty($vanban)) {
                        echo $vanban;
                    } else {
                        $ten = isset($_GET['ten']) ? $_GET['ten'] : '';
                        echo $ten;
                    } ?></span>
                </form>
            </div>
        </div>

        <div id="editor" contenteditable="true">
            <?php
            include "../Model/tgc_model.php";
            $model = new tgc_model();
            $vanban = isset($_POST['tenGhiChu']) ? $_POST['tenGhiChu'] : "";

            if (isset($vanban) && !empty($vanban)) {
                $users = $model->view($vanban);
            } else {
                $ten = isset($_GET['ten']) ? $_GET['ten'] : '';
                $users = $model->view($ten);
            }
            ?>
            <?php foreach ($users as $vb): ?>
                <p><?php echo $vb['vanban']; ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="script_ne.js"></script>
</body>

</html>