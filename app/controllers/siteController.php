<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller {

    public function loadAbout() {
        $params = [
            'name' => "Sidik",
            'cssFile' => 'index.css'
        ];
        return Application::$app->router->renderView("about", $params);
    }

    public function loadHome() {
        $params = [
            'name' => "Sidik",
            'cssFile' => 'index.css'
        ];
        return Application::$app->router->renderView("home", $params);
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

    public function loadProfile() {
        $params = [
            'name' => "Sidik"
        ];
        return $this->render('user', $params);
    }

    

    public function submit() {
        return 'Handling data';
    }
}
