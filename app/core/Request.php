<?php

namespace app\core;

class Request {
    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $posotion = strpos($path,'?');

        if ($posotion === false) {
            return $path;
        }

        return substr($path,0, $posotion);
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    
}