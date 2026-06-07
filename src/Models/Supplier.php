<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Supplier
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = "
            SELECT *
            FROM suppliers
            ORDER BY company_name ASC
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
            FROM suppliers
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $supplier = $stmt->fetch();

        return $supplier ?: null;
    }

    public function companyExists(
        string $companyName
    ): bool {

        $stmt = $this->pdo->prepare("
            SELECT id
            FROM suppliers
            WHERE company_name = :company_name
            LIMIT 1
        ");

        $stmt->execute([
            ':company_name' => $companyName
        ]);

        return (bool)$stmt->fetch();
    }

    public function create(
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            INSERT INTO suppliers
            (
                company_name,
                contact_person,
                email,
                phone,
                address,
                website,
                tax_id,
                payment_terms,
                rating,
                is_active
            )
            VALUES
            (
                :company_name,
                :contact_person,
                :email,
                :phone,
                :address,
                :website,
                :tax_id,
                :payment_terms,
                :rating,
                1
            )
        ");

        return $stmt->execute([
            ':company_name' => $data['company_name'],
            ':contact_person' => $data['contact_person'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':website' => $data['website'],
            ':tax_id' => $data['tax_id'],
            ':payment_terms' => $data['payment_terms'],
            ':rating' => $data['rating']
        ]);
    }

    public function update(
        int $id,
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            UPDATE suppliers
            SET
                company_name = :company_name,
                contact_person = :contact_person,
                email = :email,
                phone = :phone,
                address = :address,
                website = :website,
                tax_id = :tax_id,
                payment_terms = :payment_terms,
                rating = :rating
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':company_name' => $data['company_name'],
            ':contact_person' => $data['contact_person'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':website' => $data['website'],
            ':tax_id' => $data['tax_id'],
            ':payment_terms' => $data['payment_terms'],
            ':rating' => $data['rating']
        ]);
    }

    public function setActive(
        int $id,
        int $status
    ): bool {

        $stmt = $this->pdo->prepare("
            UPDATE suppliers
            SET is_active = :status
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':status' => $status
        ]);
    }
}
