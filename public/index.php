<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController;
use app\controllers\AuthController;
use app\core\Application; 

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

$app->router->post('/', [new SiteController, 'submit']);


$app->run();
