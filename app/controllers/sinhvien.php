<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index($limit = 5, $offset = 0) {
        $search = $_GET['search'] ?? '';
        
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $search);

        $sinhvien = $result['sinhvien'] ?? [];
        $totalPage = $result['totalPage'] ?? 0;
        $totalRecord = $result['totalRecord'] ?? 0;

        $this->view('sinhvien/index', [
            'title' => 'Danh sách sinh viên',
            'sinhvien' => $sinhvien,
            'totalPage' => $totalPage,
            'totalRecord' => $totalRecord,
            'limit' => $limit,
            'offset' => $offset,
            'search' => $search
        ]);
    }

    public function create() {
        $lopModel = $this->model('lopModel');
        $classes = $lopModel->getAllLop();

        $this->view('sinhvien/create', [
            'title' => 'Thêm sinh viên',
            'classes' => $classes
        ]);
    }

    public function edit($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getSinhvienById($id);

        if (!$sinhvien) {
            $_SESSION['error'] = "Không tìm thấy sinh viên!";
            header('Location: /sinhvien/index');
            exit();
        }

        $lopModel = $this->model('lopModel');
        $classes = $lopModel->getAllLop();

        $this->view('sinhvien/edit', [
            'title' => 'Chỉnh sửa sinh viên',
            'sinhvien' => $sinhvien,
            'classes' => $classes
        ]);
    }

    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = trim($_POST['hoten'] ?? '');
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $mssv = trim($_POST['mssv'] ?? '');
            $MaLop = $_POST['MaLop'] ?? '';

            // Kiểm tra trống
            if (empty($hoten) || empty($mssv)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ họ tên và MSSV!";
                header('Location: /sinhvien/create');
                exit();
            }

            // Kiểm tra độ dài và chữ số của MSSV (đúng 6 chữ số)
            if (strlen($mssv) !== 6 || !ctype_digit($mssv)) {
                $_SESSION['error'] = "Mã số sinh viên (MSSV) phải gồm đúng 6 chữ số!";
                header('Location: /sinhvien/create');
                exit();
            }

            $sinhvienModel = $this->model('sinhvienModel');

            // Kiểm tra trùng lặp MSSV
            if ($sinhvienModel->checkMssvExists($mssv)) {
                $_SESSION['error'] = "Mã số sinh viên (MSSV) đã tồn tại trong hệ thống!";
                header('Location: /sinhvien/create');
                exit();
            }

            $result = $sinhvienModel->create($hoten, $gioi_tinh, $mssv, $MaLop);
            if ($result) {
                $_SESSION['success'] = "Thêm sinh viên thành công!";
                header('Location: /sinhvien/index');
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi thêm sinh viên!";
                header('Location: /sinhvien/create');
                exit();
            }
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = trim($_POST['hoten'] ?? '');
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $mssv = trim($_POST['mssv'] ?? '');
            $MaLop = $_POST['MaLop'] ?? '';

            if (empty($hoten) || empty($mssv)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ họ tên và MSSV!";
                header("Location: /sinhvien/edit/$id");
                exit();
            }

            if (strlen($mssv) !== 6 || !ctype_digit($mssv)) {
                $_SESSION['error'] = "Mã số sinh viên (MSSV) phải gồm đúng 6 chữ số!";
                header("Location: /sinhvien/edit/$id");
                exit();
            }

            $sinhvienModel = $this->model('sinhvienModel');

            // Kiểm tra trùng lặp MSSV (loại trừ ID hiện tại)
            if ($sinhvienModel->checkMssvExists($mssv, $id)) {
                $_SESSION['error'] = "Mã số sinh viên (MSSV) đã tồn tại trong hệ thống!";
                header("Location: /sinhvien/edit/$id");
                exit();
            }

            $result = $sinhvienModel->update($id, $hoten, $gioi_tinh, $mssv, $MaLop);

            if ($result) {
                $_SESSION['success'] = "Cập nhật sinh viên thành công!";
                header('Location: /sinhvien/index');
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật sinh viên!";
                header("Location: /sinhvien/edit/$id");
                exit();
            }
        }
    }

    public function delete($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->delete($id);

        if ($result) {
            $_SESSION['success'] = "Xóa sinh viên thành công!";
        } else {
            $_SESSION['error'] = "Lỗi khi xóa sinh viên!";
        }
        header('Location: /sinhvien/index');
        exit();
    }
}
?>