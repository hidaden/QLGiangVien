// Hàm áp dụng định dạng văn bản
function applyStyle(styleType) {
    const selectedText = window.getSelection();
    if (!selectedText.rangeCount) return;

    const range = selectedText.getRangeAt(0);
    const content = range.extractContents();

    let newNode = document.createElement("span");

    // Kiểm tra xem phần tử đã có định dạng hay chưa
    switch (styleType) {
        case 'bold':
            if (selectedText.anchorNode.parentNode.style.fontWeight === "bold") {
                newNode.style.fontWeight = "normal"; // Bỏ đậm
            } else {
                newNode.style.fontWeight = "bold"; // Áp dụng đậm
            }
            break;
        case 'italic':
            if (selectedText.anchorNode.parentNode.style.fontStyle === "italic") {
                newNode.style.fontStyle = "normal"; // Bỏ nghiêng
            } else {
                newNode.style.fontStyle = "italic"; // Áp dụng nghiêng
            }
            break;
        case 'underline':
            if (selectedText.anchorNode.parentNode.style.textDecoration === "underline") {
                newNode.style.textDecoration = "none"; // Bỏ gạch chân
            } else {
                newNode.style.textDecoration = "underline"; // Áp dụng gạch chân
            }
            break;
        case 'strikethrough':
            if (selectedText.anchorNode.parentNode.style.textDecoration === "line-through") {
                newNode.style.textDecoration = "none"; // Bỏ gạch ngang
            } else {
                newNode.style.textDecoration = "line-through"; // Áp dụng gạch ngang
            }
            break;
    }

    newNode.appendChild(content);
    range.insertNode(newNode);
}

// Hàm thay đổi font chữ
function changeFont(fontName) {
    const selectedText = window.getSelection();
    if (!selectedText.rangeCount) return;

    const range = selectedText.getRangeAt(0);
    const content = range.extractContents();
    let newNode = document.createElement("span");
    newNode.style.fontFamily = fontName;
    newNode.appendChild(content);
    range.insertNode(newNode);
}

// Hàm thay đổi kích thước chữ
function changeFontSize(fontSize) {
    const selectedText = window.getSelection();
    if (!selectedText.rangeCount) return;

    const range = selectedText.getRangeAt(0);
    const content = range.extractContents();
    let newNode = document.createElement("span");
    newNode.style.fontSize = fontSize;
    newNode.appendChild(content);
    range.insertNode(newNode);
}

// Hàm thay đổi màu chữ
function changeColor(color) {
    const selectedText = window.getSelection();
    if (!selectedText.rangeCount) return;

    const range = selectedText.getRangeAt(0);
    const content = range.extractContents();
    let newNode = document.createElement("span");
    newNode.style.color = color;
    newNode.appendChild(content);
    range.insertNode(newNode);
}
// Hàm áp dụng màu đánh dấu (highlight)
function highlightText(color) {
    const selectedText = window.getSelection();
    if (!selectedText.rangeCount) return;

    const range = selectedText.getRangeAt(0);
    const content = range.extractContents();

    let newNode = document.createElement("span");
    newNode.style.backgroundColor = color; // Đặt màu nền cho văn bản được chọn
    newNode.appendChild(content);
    range.insertNode(newNode);
}

// Hàm căn lề
function alignText(alignment) {
    document.getElementById("editor").style.textAlign = alignment;
}

// Hàm chèn danh sách
function insertList(type) {
    const editor = document.getElementById("editor");
    const selectedText = window.getSelection();
    if (!selectedText.rangeCount) return;

    const range = selectedText.getRangeAt(0);

    let listTag = document.createElement(type === 'ordered' ? 'ol' : 'ul');
    let listItem = document.createElement('li');
    listItem.textContent = selectedText.toString();
    listTag.appendChild(listItem);

    range.deleteContents();
    range.insertNode(listTag);
}



function saveContent() {

    const editorContent = document.getElementById("editor").innerHTML;
    document.getElementById("editorContent").value = editorContent;

    const spanText = document.getElementById('spanElement').innerText;
    document.getElementById('spanContent').value = spanText;

}


let selectedImage = null; // Biến lưu trữ hình ảnh đã chọn

// Xác định hình ảnh đã được nhấp vào
document.getElementById("editor").addEventListener("click", function (event) {
    if (event.target.tagName === "IMG") {
        selectedImage = event.target;
    } else {
        selectedImage = null;
    }
});


document.getElementById("editor").addEventListener("click", function (event) {
    if (event.target.tagName === "IMG") {
        selectedImage = event.target;
    } else {
        selectedImage = null;
    }
});

// Function to resize the selected image
function resizeSelectedImage(action) {
    if (!selectedImage) return;

    const currentWidth = selectedImage.offsetWidth;
    const resizeAmount = 30;

    if (action === 'increase') {
        selectedImage.style.width = (currentWidth + resizeAmount) + "px";
    } else if (action === 'decrease') {
        selectedImage.style.width = Math.max(currentWidth - resizeAmount, 20) + "px";
    }
}

// Function to insert an image into the editor
function insertImage(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        const img = document.createElement("img");
        img.src = e.target.result;
        img.style.maxWidth = "100%";
        img.style.height = "auto";

        const selectedText = window.getSelection();
        if (!selectedText.rangeCount) return;

        const range = selectedText.getRangeAt(0);
        range.insertNode(img);

        event.target.value = "";
    };
    reader.readAsDataURL(file);
}
