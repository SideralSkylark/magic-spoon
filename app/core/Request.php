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

    public function method() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() {
        return $this->method() == 'get';
    }

    public function isPost() {
        return $this->method() == 'post';
    }

    public function getBody() {
        $body = [];
    
        // If it's a GET request, retrieve data from $_GET
        if ($this->method() === 'get') {
            return $_GET;
        }
    
        // If it's a POST request, retrieve data from $_POST
        if ($this->method() === 'post') {
            return $_POST;
        }
    
        return $body;
    }
    
}