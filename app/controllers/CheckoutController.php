<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\ProductModel;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if ($requestData === null && json_last_error() !== JSON_ERROR_NONE) {
            return $this->jsonResponse(['error' => 'Invalid JSON format'], 400);
        }

        $productModel = new ProductModel(Application::$app->getDatabase()->getPDO());

        foreach ($requestData as $cartItem) {
            $productId = $cartItem['id'];
            $quantity = $cartItem['quantity'];

            error_log("Updating stock for product ID: $productId, Quantity: $quantity");

            $productModel->updateProduct($productId, $quantity);
        }

        // Send a success message back to the client
        return $this->jsonResponse(['message' => 'Checkout successful'], 200);
    }
}
