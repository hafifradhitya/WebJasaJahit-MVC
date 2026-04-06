<?php
class Database {
    private string $host = 'localhost';
    private string $user = 'root';
    private string $pass = '';
    private string $dbname = 'webjasajahit_mvc';
    private PDO $dbh;
    private $stmt;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("DB Connection Error: " . $e->getMessage());
        }
    }

    public function query(string $query): void {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind(string $param, mixed $value, int $type = null): void {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR
            };
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(): bool {
        return $this->stmt->execute();
    }

    public function resultSet(): array {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single(): object|false {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(): int {
        return $this->stmt->rowCount();
    }

    public function lastInsertId(): string|false {
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(): bool {
        return $this->dbh->beginTransaction();
    }

    public function commit(): bool {
        return $this->dbh->commit();
    }

    public function rollback(): bool {
        return $this->dbh->rollBack();
    }
}