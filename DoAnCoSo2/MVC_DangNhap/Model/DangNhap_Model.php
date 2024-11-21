<?php
class DangNhap_Model
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

    public function view()
    {
        $result = $this->conn->query("SELECT * FROM nguoidung");
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row; // Lưu mỗi hàng vào mảng users
            }
        }
        return $users; // Trả về mảng các giảng viên
    }

    public function close()
    {
        $this->conn->close();
    }
}