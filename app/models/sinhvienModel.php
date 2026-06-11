<?php
    require_once '../app/core/DB.php';
    class sinhvienModel {
        private $conn;
        public function __construct() {
            $this -> conn = ConnectDB::Connect();
        }

        public function getAllSinhvien() {
            $query = "SELECT * FROM sinhvien";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        public function create($HoTen, $GioiTinh, $MSSV) {
            $query = "INSERT INTO sinhvien (HoTen, GioiTinh, MSSV) VALUES (:HoTen, :GioiTinh, :MSSV)";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':HoTen', $HoTen);
            $stmt -> bindParam(':GioiTinh', $GioiTinh);
            $stmt -> bindParam(':MSSV', $MSSV);
            if($stmt -> execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function paging ($limit = 5, $offset = 0, $search = "") {
            $query = "SELECT * FROM sinhvien LIMIT :limit OFFSET :offset";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt -> bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt -> execute();
            $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

            //tính tổng số bản ghi để tính tổng số trang
            $selectAllQuery = $this -> conn -> query("SELECT COUNT(*) as total FROM sinhvien");
            $totalRecord = $selectAllQuery -> fetchColumn();

            $totalPage = ceil($totalRecord / $limit);

            return [
                'sinhvien' => $result,
                'totalPage' => (int) $totalPage
            ];
        }
        public function delete($id) {
            $query = "DELETE FROM sinhvien WHERE id = :id";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
            if($stmt -> execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function getSinhvienById($id) {
            $query = "SELECT * FROM sinhvien WHERE id = :id";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
            $stmt -> execute();
            return $stmt -> fetch(PDO::FETCH_ASSOC);
        }
        public function update($id, $HoTen, $GioiTinh, $MSSV) {
            $query = "UPDATE sinhvien SET HoTen = :HoTen, GioiTinh = :GioiTinh, MSSV = :MSSV WHERE id = :id";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
            $stmt -> bindParam(':HoTen', $HoTen);
            $stmt -> bindParam(':GioiTinh', $GioiTinh);
            $stmt -> bindParam(':MSSV', $MSSV);
            if($stmt -> execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
    
?>