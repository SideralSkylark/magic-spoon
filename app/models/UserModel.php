<?php

namespace app\models;

use app\core\Model;
use PDO;

class UserModel extends Model
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';

    public function __construct(PDO $pdo) {
        parent::__construct($pdo);
    }

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
        ];
    }

    public function tableName(): string
    {
        return 'users'; 
    }

    public function register(): bool
    {
        if ($this->validate()) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO {$this->tableName()} (firstName, lastName, email, password) 
                    VALUES (:firstName, :lastName, :email, :password)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':firstName', $this->firstName);
            $stmt->bindValue(':lastName', $this->lastName);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':password', $this->password);

            return $stmt->execute();
        }
        return false;
    }

    public function login(): bool
    {
        $user = $this->findUser(['email' => $this->email]);
        if ($user) {
            if (password_verify($this->password, $user->password)) {
                return true;
            }
        }
        return false;
    }

    public function findUser(array $conditions): ?UserModel
    {
        $tableName = $this->tableName();
        $attributes = array_keys($conditions);
        $whereClause = implode(' AND ', array_map(fn($attr) => "$attr = :$attr", $attributes));

        $sql = "SELECT * FROM $tableName WHERE $whereClause LIMIT 1";
        $stmt = $this->pdo->prepare($sql);

        foreach ($conditions as $attribute => $value) {
            $stmt->bindValue(":$attribute", $value);
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user = new self($this->pdo);
            $user->loadData($result);
            return $user;
        }

        return null;
    }

    public function attributes(): array {
        return ['firstName', 'lastName', 'email', 'password']; 
    }
}
