<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = "
            SELECT
                id,
                username,
                email,
                full_name,
                role,
                department,
                phone,
                is_active,
                created_at
            FROM users
            ORDER BY id ASC
        ";

        return $this->pdo
            ->query($sql)
            ->fetchAll();
    }

    public function findById(
        int $id
    ): ?array {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findByUsernameOrEmail(
        string $login
    ): ?array {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE username = :username
               OR email = :email
            LIMIT 1
        ");

        $stmt->execute([
            ':username' => $login,
            ':email' => $login
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function usernameExists(
    string $username
    ): bool {

    $stmt = $this->pdo->prepare("
        SELECT id
        FROM users
        WHERE username = :username
        LIMIT 1
    ");

    $stmt->execute([
        ':username' => $username
    ]);

    return (bool) $stmt->fetch();

    }

    public function emailExists(
    string $email
    ): bool {

    $stmt = $this->pdo->prepare("
        SELECT id
        FROM users
        WHERE email = :email
        LIMIT 1
    ");

    $stmt->execute([
        ':email' => $email
    ]);

    return (bool) $stmt->fetch();

    }

    public function create(
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            INSERT INTO users
            (
                username,
                email,
                password_hash,
                full_name,
                role,
                department,
                phone,
                is_active
            )
            VALUES
            (
                :username,
                :email,
                :password_hash,
                :full_name,
                :role,
                :department,
                :phone,
                1
            )
        ");

        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password_hash' => password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            ),
            ':full_name' => $data['full_name'],
            ':role' => $data['role'],
            ':department' => $data['department'],
            ':phone' => $data['phone']
        ]);
    }

    public function update(
        int $id,
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            UPDATE users
            SET
                full_name = :full_name,
                email = :email,
                role = :role,
                department = :department,
                phone = :phone
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':full_name' => $data['full_name'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':department' => $data['department'],
            ':phone' => $data['phone']
        ]);
    }

    public function setActive(
        int $id,
        int $status
    ): bool {

        $stmt = $this->pdo->prepare("
            UPDATE users
            SET is_active = :status
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':status' => $status
        ]);
    }
}
