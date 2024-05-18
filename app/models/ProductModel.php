<?php

namespace app\models;

use app\core\Model;
use PDO;

class ProductModel extends Model
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function updateProduct($productId, $quantity)
    {
    try {
        // Get the current product details
        $statement = $this->pdo->prepare("SELECT * FROM cereals WHERE id = :id");
        $statement->bindValue(':id', $productId);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            return ['error' => 'Product not found'];
        }

        // Calculate new values
        $newStock = max($product['stock'] - $quantity, 0);
        $newCasesSold = $product['cases_sold'] + $quantity;
        $newCasseNumber = $product['cases_number'] - $quantity;

        // Update the product in the database
        $updateStatement = $this->pdo->prepare("
            UPDATE cereals 
            SET stock = :stock, cases_sold = :cases_sold, cases_number = :cases_number
            WHERE id = :id
        ");
        $updateStatement->bindValue(':id', $productId);
        $updateStatement->bindValue(':stock', $newStock);
        $updateStatement->bindValue(':cases_sold', $newCasesSold);
        $updateStatement->bindValue(':cases_number', $newCasseNumber);
        $updateStatement->execute();

        return ['success' => 'Product updated successfully'];
    } catch (\PDOException $e) {
        // Handle the PDO exception, e.g., log the error or return an error response
        return ['error' => 'An error occurred while updating product'];
    }
}

}
