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
        

        return 'Handling data';
    }

    public function loadShopVariety() {
        return $this->render('shopVariety');
    }

    public function loadShopFruety() {
        return $this->render('shopFruety');
    }

    public function loadShopCocoa() {
        return $this->render('shopCocoa');
    }

    public function loadShopPeanutButter() {
        return $this->render('shopPeanutButter');
    }

    public function loadShopFrosted() {
        return $this->render('shopFrosted');
    }

    public function loadShopMappleWaffle() {
        return $this->render('shopMappleWaffle');
    }

    public function loadShopCinnamonRoll() {
        return $this->render('shopCinnamonRoll');
    }

    public function loadshopBlueberryMuffin() {
        return $this->render('shopBlueberryMuffin');
    }
}
