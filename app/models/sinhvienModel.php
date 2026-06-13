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

        public function paging($limit = 5, $offset = 0, $search = "", $sortBy = 'mssv', $sortDir = 'ASC') {
            $searchQuery = "";
            $params = [];
            if (!empty($search)) {
                $searchLower = mb_strtolower($search, 'UTF-8');
                $searchQuery = " WHERE (LOWER(s.hoten) COLLATE utf8_bin LIKE :search
                                    OR s.mssv LIKE :search_exact
                                    OR s.MaLop LIKE :search_exact2
                                    OR LOWER(l.TenLop) COLLATE utf8_bin LIKE :search3)";
                $params[':search']        = '%' . $searchLower . '%';
                $params[':search_exact']  = '%' . $search . '%';
                $params[':search_exact2'] = '%' . $search . '%';
                $params[':search3']       = '%' . $searchLower . '%';
            }

            // Whitelist để tránh SQL injection
            $allowedSort = ['mssv', 'hoten', 'id'];
            $allowedDir  = ['ASC', 'DESC'];
            $sortBy  = in_array($sortBy, $allowedSort)  ? $sortBy  : 'id';
            $sortDir = in_array(strtoupper($sortDir), $allowedDir) ? strtoupper($sortDir) : 'DESC';

            $query = "SELECT s.*, l.TenLop FROM tbl_sinh_vien s LEFT JOIN tbl_lop l ON s.MaLop = l.MaLop" . $searchQuery . " ORDER BY s.{$sortBy} {$sortDir} LIMIT :limit OFFSET :offset";
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