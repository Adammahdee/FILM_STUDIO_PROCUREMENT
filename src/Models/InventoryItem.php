<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class InventoryItem
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT
                i.*,
                c.name AS category_name,
                s.company_name AS supplier_name
            FROM inventory_items i
            LEFT JOIN categories c
                ON c.id = i.category_id
            LEFT JOIN suppliers s
                ON s.id = i.supplier_id
            ORDER BY i.name ASC
        ");

        return $stmt->fetchAll();
    }

    public function findById(
        int $id
    ): ?array {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM inventory_items
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $item = $stmt->fetch();

        return $item ?: null;
    }

    public function itemCodeExists(
        string $itemCode
    ): bool {

        $stmt = $this->pdo->prepare("
            SELECT id
            FROM inventory_items
            WHERE item_code = :item_code
            LIMIT 1
        ");

        $stmt->execute([
            ':item_code' => $itemCode
        ]);

        return (bool)$stmt->fetch();
    }

    public function create(
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            INSERT INTO inventory_items
            (
                item_code,
                name,
                description,
                category_id,
                supplier_id,
                unit_of_measure,
                unit_price,
                quantity_in_stock,
                reorder_level,
                reorder_quantity,
                location,
                status
            )
            VALUES
            (
                :item_code,
                :name,
                :description,
                :category_id,
                :supplier_id,
                :unit_of_measure,
                :unit_price,
                :quantity_in_stock,
                :reorder_level,
                :reorder_quantity,
                :location,
                :status
            )
        ");

        return $stmt->execute([
            ':item_code' => $data['item_code'],
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':category_id' => $data['category_id'],
            ':supplier_id' => $data['supplier_id'],
            ':unit_of_measure' => $data['unit_of_measure'],
            ':unit_price' => $data['unit_price'],
            ':quantity_in_stock' => $data['quantity_in_stock'],
            ':reorder_level' => $data['reorder_level'],
            ':reorder_quantity' => $data['reorder_quantity'],
            ':location' => $data['location'],
            ':status' => $data['status']
        ]);
    }

    public function update(
        int $id,
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            UPDATE inventory_items
            SET
                item_code = :item_code,
                name = :name,
                description = :description,
                category_id = :category_id,
                supplier_id = :supplier_id,
                unit_of_measure = :unit_of_measure,
                unit_price = :unit_price,
                quantity_in_stock = :quantity_in_stock,
                reorder_level = :reorder_level,
                reorder_quantity = :reorder_quantity,
                location = :location,
                status = :status
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':item_code' => $data['item_code'],
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':category_id' => $data['category_id'],
            ':supplier_id' => $data['supplier_id'],
            ':unit_of_measure' => $data['unit_of_measure'],
            ':unit_price' => $data['unit_price'],
            ':quantity_in_stock' => $data['quantity_in_stock'],
            ':reorder_level' => $data['reorder_level'],
            ':reorder_quantity' => $data['reorder_quantity'],
            ':location' => $data['location'],
            ':status' => $data['status']
        ]);
    }

    public function setStatus(
        int $id,
        string $status
    ): bool {

        $stmt = $this->pdo->prepare("
            UPDATE inventory_items
            SET status = :status
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id,
            ':status' => $status
        ]);
    }

    public function getCategories(): array
    {
        $stmt = $this->pdo->query("
            SELECT
                id,
                name
            FROM categories
            ORDER BY name ASC
        ");

        return $stmt->fetchAll();
    }

    public function getSuppliers(): array
    {
        $stmt = $this->pdo->query("
            SELECT
                id,
                company_name
            FROM suppliers
            WHERE is_active = 1
            ORDER BY company_name ASC
        ");

        return $stmt->fetchAll();
    }
}
