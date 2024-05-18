<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController;
use app\controllers\AuthController;
use app\core\Application; 
use app\controllers\CheckoutController;

$app = new Application(dirname(__DIR__));

$app->router->get('/about', [new SiteController,'loadAbout']);
$app->router->get('/', [new SiteController, 'loadHome']);
$app->router->get('/shop', [new SiteController, 'loadShop']);
$app->router->get('/cereal', [new SiteController, 'loadCereal']);
$app->router->get('/treats', [new SiteController, 'loadTreats']);
$app->router->get('/bundles', [new SiteController, 'loadBundles']);
$app->router->get('/login',[new SiteController, 'loadProfile']);
$app->router->post('/login', [new AuthController,'submitLogin']);
$app->router->get('/cart',[new SiteController, 'loadCart']);
$app->router->get('/register', [new SiteController, 'loadRegisterPage']);
$app->router->post('/register', [new AuthController,'register']);

$app->router->get('/shopVariety', [new SiteController,'loadShopVariety']);
$app->router->get('/shopFruety', [new SiteController,'loadShopFruety']);
$app->router->get('/shopCocoa', [new SiteController,'loadShopCocoa']);
$app->router->get('/shopPeanutButter', [new SiteController,'loadShopPeanutButter']);
$app->router->get('/shopFrosted', [new SiteController,'loadShopFrosted']);
$app->router->get('/shopMappleWaffle', [new SiteController,'loadShopMappleWaffle']);
$app->router->get('/shopCinnamonRoll', [new SiteController,'loadShopCinnamonRoll']);
$app->router->get('/shopBlueberryMuffin', [new SiteController,'loadShopBlueberryMuffin']);

$app->router->post('/', [new SiteController, 'submit']);
$app->router->post('/cart/checkout', [new CheckoutController, 'checkout']);


$app->run();
