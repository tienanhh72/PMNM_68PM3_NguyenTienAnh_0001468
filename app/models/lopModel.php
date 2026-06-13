<?php
    require_once '../app/core/DB.php';
    class lopModel {
        private $conn;
        public function __construct() {
            $this->conn = ConnectDB::Connect();
        }

        public function getAllLop() {
            $query = "SELECT * FROM tbl_lop ORDER BY MaLop ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function create($MaLop, $TenLop, $GhiChu) {
            $query = "INSERT INTO tbl_lop (MaLop, TenLop, GhiChu) VALUES (:MaLop, :TenLop, :GhiChu)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaLop', $MaLop);
            $stmt->bindParam(':TenLop', $TenLop);
            $stmt->bindParam(':GhiChu', $GhiChu);
            return $stmt->execute();
        }

        public function paging($limit = 5, $offset = 0, $search = "") {
            $searchQuery = "";
            $params = [];
            if (!empty($search)) {
                $searchQuery = " WHERE MaLop LIKE :search OR TenLop LIKE :search OR GhiChu LIKE :search";
                $params[':search'] = '%' . $search . '%';
            }

            $query = "SELECT * FROM tbl_lop" . $searchQuery . " ORDER BY STT DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val);
            }
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Tính tổng số bản ghi
            $countQuery = "SELECT COUNT(*) as total FROM tbl_lop" . $searchQuery;
            $countStmt = $this->conn->prepare($countQuery);
            foreach ($params as $key => $val) {
                $countStmt->bindValue($key, $val);
            }
            $countStmt->execute();
            $totalRecord = $countStmt->fetchColumn();

            $totalPage = ceil($totalRecord / $limit);

            return [
                'lop' => $result,
                'totalPage' => (int) $totalPage,
                'totalRecord' => (int) $totalRecord
            ];
        }

        public function delete($stt) {
            $query = "DELETE FROM tbl_lop WHERE STT = :stt";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':stt', $stt, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function getLopBySTT($stt) {
            $query = "SELECT * FROM tbl_lop WHERE STT = :stt";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':stt', $stt, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getLopByMaLop($MaLop) {
            $query = "SELECT * FROM tbl_lop WHERE MaLop = :MaLop";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaLop', $MaLop);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($stt, $MaLop, $TenLop, $GhiChu) {
            $query = "UPDATE tbl_lop SET MaLop = :MaLop, TenLop = :TenLop, GhiChu = :GhiChu WHERE STT = :stt";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':stt', $stt, PDO::PARAM_INT);
            $stmt->bindParam(':MaLop', $MaLop);
            $stmt->bindParam(':TenLop', $TenLop);
            $stmt->bindParam(':GhiChu', $GhiChu);
            return $stmt->execute();
        }

        public function checkMaLopExists($MaLop, $excludeSTT = null) {
            $query = "SELECT COUNT(*) FROM tbl_lop WHERE MaLop = :MaLop";
            if ($excludeSTT !== null) {
                $query .= " AND STT != :stt";
            }
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaLop', $MaLop);
            if ($excludeSTT !== null) {
                $stmt->bindParam(':stt', $excludeSTT, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }

        public function hasStudents($MaLop) {
            $query = "SELECT COUNT(*) FROM tbl_sinh_vien WHERE MaLop = :MaLop";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaLop', $MaLop);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
    }
?>
