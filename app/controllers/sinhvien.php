
<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index($limit = 5, $offset = 0, $search = "") {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $search);

        $sinhvien = $result['sinhvien'] ?? [];
        $totalPage = $result['totalPage'] ?? 0;

        $this->view('sinhvien/index', [
            'title' => 'Danh sách sinh viên',
            'sinhvien' => $sinhvien,
            'totalPage' => $totalPage
        ]);
    }

    public function create() {
        $this->view('sinhvien/create', [
            'title' => 'Thêm sinh viên'
        ]);
    }

    public function edit($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getSinhvienById($id);

        if (!$sinhvien) {
            header('Location: /sinhvien/index');
            exit();
        }

        $this->view('sinhvien/edit', [
            'title' => 'Chỉnh sửa sinh viên',
            'sinhvien' => $sinhvien
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $HoTen, $GioiTinh, $MSSV);

            if ($result) {
                header('Location: /sinhvien/index');
                exit();
            }

            echo 'Lỗi khi cập nhật sinh viên!';
        }
    }

    public function delete($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->delete($id);

        if ($result) {
            header('Location: /sinhvien/index');
            exit();
        }

        echo 'Lỗi khi xóa sinh viên!';
    }

    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($HoTen, $GioiTinh, $MSSV);
            if ($result) {
                header('Location: /sinhvien/index');
                exit();
            } else {
                echo "Lỗi khi thêm sinh viên!";
            }
        }
    }
}