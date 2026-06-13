<?php
require_once '../app/core/Controller.php';
class home extends Controller {
    public function index() {
        $this->view('home/index', [
            'title' => 'Trang chủ - Hệ thống Quản lý'
        ]);
    }
    public function login() {
        require_once '../app/views/home/login.php';
    }
}
?>