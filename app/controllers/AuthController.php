<?php

namespace App\Controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\UserModel;

class AuthController extends Controller {
    public function submitLogin(Request $request) {
        $email = $request->getBody()['email'] ?? null;
        $password = $request->getBody()['password'] ?? null;

        $userModel = new UserModel(Application::$app->database->getPDO());
        $userModel->email = $email;
        $userModel->password = $password;

        if ($userModel->login()) {
            return $this->render('user');
        } else {
            return $this->render('login', ['error' => 'Invalid email or password']);
        }
    }

    public function register(Request $request) {
        $userModel = new UserModel(Application::$app->database->getPDO());
        $userModel->loadData($request->getBody()['custumer'] ?? []);
    
        if ($userModel->register()) {
            header('Location: /login');
        } else {
            return $this->render('register', ['model'=> $userModel]);
        }
    }
    
}
