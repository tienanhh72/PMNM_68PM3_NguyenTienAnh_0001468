<?php
class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($viewName, $data = []) {
        extract($data);
        $viewname = $viewName;
        // Nếu là AJAX request thì chỉ render view, không có layout
        if (!empty($_GET['ajax'])) {
            require_once '../app/views/' . $viewname . '.php';
        } else {
            require_once '../app/views/layout/masterlayout.php';
        }
    }
}