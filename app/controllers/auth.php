<?php
    class auth {
        protected $user = array(
            'admin' => '123456',
            'tienanh' => '123456'
        );
        public function login() {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $SESSION['username'] = $username;
                $username = $_POST['username'];
                $password = $_POST['password'];
                if (isset($this->user[$username]) && $this->user[$username] === $password) {
                    header('Location: /home/index');
                    exit();
                } else {
                    header('Location: /home/login');
                    exit();
                }
            }
        }
    }