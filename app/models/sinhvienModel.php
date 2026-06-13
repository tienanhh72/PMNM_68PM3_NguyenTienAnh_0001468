<?php
    require_once '../app/core/DB.php';
    class sinhvienModel {
        private $conn;
        public function __construct() {
            $this->conn = ConnectDB::Connect();
        }

        public function getAllSinhvien() {
            $query = "SELECT s.*, l.TenLop FROM tbl_sinh_vien s LEFT JOIN tbl_lop l ON s.MaLop = l.MaLop ORDER BY s.id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function create($hoten, $gioi_tinh, $mssv, $MaLop) {
            $query = "INSERT INTO tbl_sinh_vien (hoten, gioi_tinh, mssv, MaLop) VALUES (:hoten, :gioi_tinh, :mssv, :MaLop)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh);
            $stmt->bindParam(':mssv', $mssv);
            $stmt->bindParam(':MaLop', $MaLop);
            return $stmt->execute();
        }

        public function paging($limit = 5, $offset = 0, $search = "") {
            $searchQuery = "";
            $params = [];
            if (!empty($search)) {
                $searchQuery = " WHERE s.hoten LIKE :search OR s.mssv LIKE :search OR s.MaLop LIKE :search OR l.TenLop LIKE :search";
                $params[':search'] = '%' . $search . '%';
            }

            $query = "SELECT s.*, l.TenLop FROM tbl_sinh_vien s LEFT JOIN tbl_lop l ON s.MaLop = l.MaLop" . $searchQuery . " ORDER BY s.id DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            
            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val);
            }
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Tính tổng số bản ghi khớp điều kiện
            $countQuery = "SELECT COUNT(*) as total FROM tbl_sinh_vien s LEFT JOIN tbl_lop l ON s.MaLop = l.MaLop" . $searchQuery;
            $countStmt = $this->conn->prepare($countQuery);
            foreach ($params as $key => $val) {
                $countStmt->bindValue($key, $val);
            }
            $countStmt->execute();
            $totalRecord = $countStmt->fetchColumn();

            $totalPage = ceil($totalRecord / $limit);

            return [
                'sinhvien' => $result,
                'totalPage' => (int) $totalPage,
                'totalRecord' => (int) $totalRecord
            ];
        }

        public function delete($id) {
            $query = "DELETE FROM tbl_sinh_vien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function getSinhvienById($id) {
            $query = "SELECT * FROM tbl_sinh_vien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id, $hoten, $gioi_tinh, $mssv, $MaLop) {
            $query = "UPDATE tbl_sinh_vien SET hoten = :hoten, gioi_tinh = :gioi_tinh, mssv = :mssv, MaLop = :MaLop WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':hoten', $hoten);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh);
            $stmt->bindParam(':mssv', $mssv);
            $stmt->bindParam(':MaLop', $MaLop);
            return $stmt->execute();
        }

        public function checkMssvExists($mssv, $excludeId = null) {
            $query = "SELECT COUNT(*) FROM tbl_sinh_vien WHERE mssv = :mssv";
            if ($excludeId !== null) {
                $query .= " AND id != :id";
            }
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':mssv', $mssv);
            if ($excludeId !== null) {
                $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
    }
?>