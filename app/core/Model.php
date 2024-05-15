<?php

namespace app\core;

use PDO;

abstract class Model {

    protected PDO $pdo;
    public array $errors = [];

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function loadData($data) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool {
        return true;
    }

    protected static function prepare($sql) {
        return self::$pdo->prepare($sql);
    }

    protected static function query($sql) {
        return self::$pdo->query($sql);
    }

    protected static function execute($sql) {
        return self::$pdo->exec($sql);
    }

    protected function fetchAll($stmt) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function fetch($stmt) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function rowCount($stmt) {
        return $stmt->rowCount();
    }
}
