<?php

namespace Model;

class Config {
    public static function get($key) {
        return getenv($key);
    }
}

// echo Config::get('APP_NAME'); // MiApp