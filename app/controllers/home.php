<?php
require_once '../app/core/Controller.php';
class home extends Controller {
    public function index() {
        header('Location: /sinhvien/index');
        exit();
    }
    public function login() {
        require_once '../app/views/home/login.php';
    }
}
?>