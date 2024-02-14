<?php

namespace App;

class Session {
    function __construct() {
        session_start();
    }

    public function add(string $key, $data) {
        $_SESSION[$key] = $data;
    }

    public function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    public function destroy() {
        session_unset();
        session_destroy();
    }

    public function isConnected() {
        return isset($_SESSION['user']);
    }
}

?>
