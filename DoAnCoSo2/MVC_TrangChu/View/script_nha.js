document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.getElementById("addButton");
    const Model = document.querySelector(".Model");
    const cancelButton = document.querySelector(".cancel-button");
    const submitButton = document.querySelector(".submit-button");
    const editButtons = document.querySelectorAll(".button-chinhsua"); // Lấy tất cả các nút chỉnh sửa
    const editModal = document.querySelector(".Model-chinhsua"); // Lấy Model chỉnh sửa
    const editCancelButton = document.querySelector(".cancel-button-chinhsua"); // Nút hủy bỏ trong Model chỉnh sửa
    const editSubmitButton = document.querySelector(".submit-button-chinhsua"); // Nút xong trong Model chỉnh sửa
    const editNameInput = editModal.querySelector('input[name="name-chinhsua"]');
    const editNameInputFirst = editModal.querySelector('input[name="name-chinhsua-dau"]');
    const deleteButtons = document.querySelectorAll(".button-xoa"); // Lấy tất cả các nút chỉnh sửa
    const deleteModal = document.querySelector(".Model-xoa"); // Lấy Model chỉnh sửa
    const deleteCancelButton = document.querySelector(".cancel-button-xoa"); // Nút hủy bỏ trong Model chỉnh sửa
    const deleteSubmitButton = document.querySelector(".submit-button-xoa"); // Nút xong trong Model chỉnh sửa
    const deleteNameInput = document.querySelector('input[name="ten_de_xoa"]');

    // THÊM
    // Hiển thị Model khi nhấn nút "Thêm"
    addButton.addEventListener("click", function () {
        Model.style.display = "flex"; // Hiển thị Model
    });

    // Ẩn Model khi nhấn nút "Hủy bỏ"
    cancelButton.addEventListener("click", function () {
        Model.style.display = "none"; // Ẩn Model
    });

    submitButton.addEventListener("click", function (event) {
        Model.style.display = "none"; // Ẩn Model
    });
    //CHỈNH SỬA
    // Hiển thị Model chỉnh sửa khi nhấn nút "Chỉnh sửa"
    editButtons.forEach(buttonn => {
        buttonn.addEventListener("click", function () {
            Model.style.display = "none"; // Ẩn Model tạo ghi chú nếu nó đang hiển thị
            editModal.style.display = "flex"; // Hiển thị Model chỉnh sửa

            const titleElement = buttonn.closest('.document-card').querySelector('.title');
            const titleText = titleElement.innerText;

            editNameInput.value = titleText;
            editNameInputFirst.value = titleText;
        });
    });

    // Ẩn Model chỉnh sửa khi nhấn nút "Hủy bỏ"
    editCancelButton.addEventListener("click", function () {
        editModal.style.display = "none"; // Ẩn Model
    });

    // Ẩn Model khi nhấn nút "Xong"
    editSubmitButton.addEventListener("click", function (event) {
        editModal.style.display = "none"; // Ẩn Model
    });

    // XÓA
    deleteButtons.forEach(buttonn => {
        buttonn.addEventListener("click", function () {
            deleteModal.style.display = "flex"; // Hiển thị Model chỉnh sửa

            const titleElement = buttonn.closest('.document-card').querySelector('.title');
            const titleText = titleElement.innerText;

            deleteNameInput.value = titleText;
        });
    });

    // Ẩn Model chỉnh sửa khi nhấn nút "Hủy bỏ"
    deleteCancelButton.addEventListener("click", function () {
        deleteModal.style.display = "none"; // Ẩn Model
    });

    // Ẩn Model khi nhấn nút "Xong"
    deleteSubmitButton.addEventListener("click", function (event) {
        deleteModal.style.display = "none"; // Ẩn Model
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const documentCards = document.querySelectorAll(".document-card");

    // Lắng nghe sự kiện nhập từ khóa tìm kiếm
    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        documentCards.forEach(function (card) {
            const titleElement = card.querySelector('.title');
            const titleText = titleElement.innerText.toLowerCase();

            // Hiển thị hoặc ẩn các card dựa trên từ khóa tìm kiếm
            if (titleText.includes(searchTerm)) {
                card.style.display = "block"; // Hiển thị
            } else {
                card.style.display = "none"; // Ẩn
            }
        });
    });
});
document.getElementById('searchInput').addEventListener('input', function () {
    const searchTerm = this.value;

    // Gửi yêu cầu tìm kiếm đến server qua AJAX
    fetch('TrangChu_Controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'search',
            search: searchTerm
        })
    })
        .then(response => response.json())
        .then(data => {
            // Cập nhật giao diện với kết quả tìm kiếm
            updateDocumentGrid(data);
        });
});

document.addEventListener("DOMContentLoaded", function () {
    const documentCards = document.querySelectorAll(".document-card");

    documentCards.forEach(card => {
        card.addEventListener("click", function (event) {
            // Kiểm tra nếu click không nằm trong các nút "Chỉnh sửa" và "Xóa"
            if (!event.target.closest(".button-chinhsua") && !event.target.closest(".button-xoa")) {
                // Lấy giá trị từ <p class="title">
                const titleElement = card.querySelector(".title");
                const titleText = titleElement.innerText;

                // Gán giá trị vào input có name="tenGhi"
                const input = card.querySelector('input[name="tenGhiChu"]');
                input.value = titleText;

                // Gửi form đi
                card.querySelector('form[action="../../MVC_TrangGhiChu/View/index.php"]').submit();
            }
        });
    });
});
// Kiểm tra nếu tham số showModal tồn tại
window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('showModal')) {
        // Hiển thị Model
        document.querySelector('.Model').style.display = 'flex';
    }
}
document.addEventListener("DOMContentLoaded", () => {
    const userIcon = document.querySelector(".user"); // Chọn biểu tượng người dùng
    const profileCard = document.querySelector(".profile-card"); // Chọn thẻ profile card

    // Ẩn profile card khi load trang
    profileCard.style.display = "none";

    // Hiển thị profile card khi nhấn vào user icon
    userIcon.addEventListener("click", (e) => {
        e.stopPropagation(); // Ngăn sự kiện lan ra ngoài
        if (profileCard.style.display === "none") {
            profileCard.style.display = "block";
        } else {
            profileCard.style.display = "none";
        }
    });

    // Ẩn profile card khi nhấn ra ngoài
    document.addEventListener("click", (e) => {
        if (!profileCard.contains(e.target) && e.target !== userIcon) {
            profileCard.style.display = "none";
        }
    });
});
