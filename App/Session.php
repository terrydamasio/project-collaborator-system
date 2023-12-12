<?php
    namespace App;

    class Session {
        
        public static function set(string $index, mixed $value) {
            $_SESSION[$index] = $value;
        }

        public static function has(string $index) {
            var_dump(isset($_SESSION[$index]));
        }

        public static function get(string $index) {
            if(self::has($index)) {
                return $_SESSION[$index];
            }
        }

        public static function remove(string $index) {
            if(self::has($index)) {
                unset($_SESSION[$index]);
            }
        }

        public static function removeAll() {
            session_destroy();
            session_unset();
        }

        public static function flash(string $index, mixed $value) {
            $_SESSION['__flash'][$index] = $value;
        }

        public static function removeFlash() {
            if($_SERVER['REQUEST_METHOD'] == 'GET' && self::has('__flash')) {
                unset($_SESSION['__flash']);
            }
        }

        public static function dump() {
            var_dump($_SESSION);
            die;
        }

    }