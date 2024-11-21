<?php
class TrangChu_Model
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
    public function add($tenGC, $vanban)
    {
        $querry = $this->conn->prepare("INSERT INTO huynguyen (tenGC,vanban) VALUES (?, ?)");
        $querry->bind_param("ss", $tenGC, $vanban);
        if ($querry->execute()) {

        } else {
            echo "Error: <br>" . $this->conn->error;
        }
    }
    public function view()
    {
        $result = $this->conn->query("SELECT * FROM huynguyen");
        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row; // Lưu mỗi hàng vào mảng users
            }
        }
        return $users; // Trả về mảng các giảng viên
    }
    public function delete($tenGC)
    {
        $querry = $this->conn->prepare("DELETE FROM huynguyen WHERE tenGC = ?");
        $querry->bind_param("s", $tenGC);
        return $querry->execute();
    }
    public function edit($tenchinhsuaFirst, $tenchinhsuaAfter)
    {
        // Chuẩn bị câu lệnh SQL với tham số
        $querry = $this->conn->prepare("UPDATE huynguyen SET tenGC = ? WHERE tenGC = ?");

        // Liên kết các tham số với giá trị
        $querry->bind_param("ss", $tenchinhsuaAfter, $tenchinhsuaFirst); // "ss" chỉ ra rằng cả hai tham số đều là chuỗi

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
    public function doiMatKhau($taikhoan, $matkhaumoi)
    {
        $querry = $this->conn->prepare("UPDATE nguoidung SET matkhau = ? WHERE taikhoan = ?");

        // Liên kết các tham số với giá trị
        $querry->bind_param("ss", $matkhaumoi, $taikhoan); // "ss" chỉ ra rằng cả hai tham số đều là chuỗi

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
    public function viewNguoiDung()
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