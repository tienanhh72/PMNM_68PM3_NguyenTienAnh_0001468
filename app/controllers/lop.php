<?php
require_once '../app/core/Controller.php';
class lop extends Controller {
    public function index($limit = 5, $offset = 0) {
        $search = $_GET['search'] ?? '';

        $lopModel = $this->model('lopModel');
        $result = $lopModel->paging($limit, $offset, $search);

        $lop = $result['lop'] ?? [];
        $totalPage = $result['totalPage'] ?? 0;
        $totalRecord = $result['totalRecord'] ?? 0;

        $this->view('lop/index', [
            'title' => 'Danh sách lớp học',
            'lop' => $lop,
            'totalPage' => $totalPage,
            'totalRecord' => $totalRecord,
            'limit' => $limit,
            'offset' => $offset,
            'search' => $search
        ]);
    }

    public function create() {
        $this->view('lop/create', [
            'title' => 'Thêm lớp học'
        ]);
    }

    public function edit($stt) {
        $lopModel = $this->model('lopModel');
        $lop = $lopModel->getLopBySTT($stt);

        if (!$lop) {
            $_SESSION['error'] = "Không tìm thấy lớp học!";
            header('Location: /lop/index');
            exit();
        }

        $this->view('lop/edit', [
            'title' => 'Chỉnh sửa lớp học',
            'lop' => $lop
        ]);
    }

    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaLop = trim($_POST['MaLop'] ?? '');
            $TenLop = trim($_POST['TenLop'] ?? '');
            $GhiChu = trim($_POST['GhiChu'] ?? '');

            if (empty($MaLop) || empty($TenLop)) {
                $_SESSION['error'] = "Vui lòng điền mã lớp và tên lớp!";
                header('Location: /lop/create');
                exit();
            }

            $lopModel = $this->model('lopModel');

            if ($lopModel->checkMaLopExists($MaLop)) {
                $_SESSION['error'] = "Mã lớp đã tồn tại!";
                header('Location: /lop/create');
                exit();
            }

            $result = $lopModel->create($MaLop, $TenLop, $GhiChu);
            if ($result) {
                $_SESSION['success'] = "Thêm lớp học thành công!";
                header('Location: /lop/index');
                exit();
            } else {
                $_SESSION['error'] = "Lỗi khi thêm lớp học!";
                header('Location: /lop/create');
                exit();
            }
        }
    }

    public function update($stt) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaLop = trim($_POST['MaLop'] ?? '');
            $TenLop = trim($_POST['TenLop'] ?? '');
            $GhiChu = trim($_POST['GhiChu'] ?? '');

            if (empty($MaLop) || empty($TenLop)) {
                $_SESSION['error'] = "Vui lòng điền mã lớp và tên lớp!";
                header("Location: /lop/edit/$stt");
                exit();
            }

            $lopModel = $this->model('lopModel');

            if ($lopModel->checkMaLopExists($MaLop, $stt)) {
                $_SESSION['error'] = "Mã lớp đã được dùng cho lớp học khác!";
                header("Location: /lop/edit/$stt");
                exit();
            }

            $result = $lopModel->update($stt, $MaLop, $TenLop, $GhiChu);
            if ($result) {
                $_SESSION['success'] = "Cập nhật lớp học thành công!";
                header('Location: /lop/index');
                exit();
            } else {
                $_SESSION['error'] = "Lỗi khi cập nhật lớp học!";
                header("Location: /lop/edit/$stt");
                exit();
            }
        }
    }

    public function delete($stt) {
        $lopModel = $this->model('lopModel');
        $lop = $lopModel->getLopBySTT($stt);

        if (!$lop) {
            $_SESSION['error'] = "Lớp học không tồn tại!";
            header('Location: /lop/index');
            exit();
        }

        // Kiểm tra xem lớp học có chứa sinh viên hay không
        if ($lopModel->hasStudents($lop['MaLop'])) {
            $_SESSION['error'] = "Không thể xóa lớp học này vì đang có sinh viên thuộc lớp!";
            header('Location: /lop/index');
            exit();
        }

        $result = $lopModel->delete($stt);
        if ($result) {
            $_SESSION['success'] = "Xóa lớp học thành công!";
        } else {
            $_SESSION['error'] = "Lỗi khi xóa lớp học!";
        }
        header('Location: /lop/index');
        exit();
    }
}
?>
