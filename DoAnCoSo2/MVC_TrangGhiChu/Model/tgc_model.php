<?php
class tgc_model
{
    private $host = "localhost";
    private $username = "root";
    private $password = "0906578681";
    private $database = "ghichu";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    public function view($tenGC)
    {
        $result = $this->conn->query("SELECT vanban FROM huynguyen WHERE tenGC='$tenGC';");
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row; // Lưu mỗi hàng vào mảng users
            }
        }
        return $users; // Trả về mảng các giảng viên
    }
    public function save($vanban, $ten)
    {
        // Chuẩn bị câu lệnh SQL với tham số
        $querry = $this->conn->prepare("UPDATE huynguyen SET vanban = ? WHERE tenGC= ?");

        // Liên kết các tham số với giá trị
        $querry->bind_param("ss", $vanban, $ten); // "ss" chỉ ra rằng cả hai tham số đều là chuỗi

        // Thực thi câu lệnh
        if ($querry->execute()) {
            // Cập nhật thành công, bạn có thể thêm mã thông báo thành công tại đây
            echo "Cập nhật thành công!";
        } else {
            // Bắt lỗi nếu có
            echo "Error: <br>" . $this->conn->error;
        }

        // Đóng câu lệnh
        $querry->close();
    }


    public function close()
    {
        $this->conn->close();
    }
}