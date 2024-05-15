<?php
namespace app\core;

class Application {

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Controller $controller;

    public Database $database;

    public function __construct($rootpath) {
        self::$app = $this;
        self::$ROOT_DIR = $rootpath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->database = new Database();
    }

    public function run() {
        echo $this->router->resolve();
    }

    public function getController(): \app\core\Controller {
        return $this->controller;
    }
    
    public function setController(\app\core\Controller $controller) {
        $this->controller = $controller;
    }
}