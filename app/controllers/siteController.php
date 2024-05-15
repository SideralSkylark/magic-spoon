<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller {

    public function loadAbout() {
        $params = [
            'cssLink' => '/style/index.css'
        ];
        return $this->render('about', $params);
    }

    public function loadHome() {
        $params = [
            'cssLink' => '/style/index.css'
        ];
        return $this->render('home', $params);
    }

    public function loadShop() {
        return Application::$app->router->renderView("shopnow");
    }

    public function loadCereal() {
        return Application::$app->router->renderView("cereal");
    }

    public function loadTreats() {
        return Application::$app->router->renderView("treats");
    }

    public function loadBundles() {
        return Application::$app->router->renderView("bundles");
    }

    public function loadCart() {
        return Application::$app->router->renderView("cart");
    }

    public function loadRegisterPage() {
        return Application::$app->router->renderView("register");
    }

    public function loadProfile() {
        $params = [
            'name' => "Sidik"
        ];
        return $this->render('login', $params);
    }

    

    public function submit(Request $request) {
        $body = $request->getBody();
        var_dump($body);

        return 'Handling data';
    }
}
