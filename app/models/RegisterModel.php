<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class RegisterModel extends Model {
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';

    public function rules(): array {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
        ];
    }

    public function register(): bool {
        if ($this->validate()) {
            $tableName = $this->tableName();
            $attributes = $this->attributes();

            $sql = "INSERT INTO $tableName ("
                . implode(', ', $attributes)
                . ") VALUES ("
                . implode(', ', array_map(fn($attr) => ":$attr", $attributes))
                . ")";

            $stmt = self::prepare($sql);

            foreach ($attributes as $attribute) {
                $stmt->bindValue(":$attribute", $this->{$attribute});
            }

            return $stmt->execute();
        }

        return false;
    }

    public function tableName(): string {
        return 'users';
    }

    public function attributes(): array {
        return ['firstName', 'lastName', 'email', 'password']; 
    }
}
