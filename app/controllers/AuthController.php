<?php 

namespace App\Controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller {
    public function submitLogin() {
        return $this->render('login');
    }

    public function register(Request $request) {
        $errors = [];
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            
            $registerModel->loadData($request->getBody());
            var_dump($registerModel);

            if ($registerModel->validate() && $registerModel->register()) {
                return header('\user');
            }

            return $this->render('register', [
                'model' => $registerModel
            ]);
            }

            return $this->render('register', [
                'model' => $registerModel
            ]);
        }

        
        
    }