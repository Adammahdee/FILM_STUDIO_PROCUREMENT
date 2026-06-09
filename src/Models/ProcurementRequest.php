<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class ProcurementRequest
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
                pr.*,
                u.full_name AS requester_name
            FROM procurement_requests pr
            LEFT JOIN users u
                ON u.id = pr.requester_id
            ORDER BY pr.id DESC
        ");

        return $stmt->fetchAll();
    }

    public function getAllItems(): array
    {
    $stmt = $this->pdo->query("
    SELECT
    id,
    item_code,
    name,
    quantity_in_stock,
    unit_price,
    status
    FROM inventory_items
    WHERE status = 'active'
    ORDER BY name ASC
    ");

    return $stmt->fetchAll();

    }

    public function findById(
        int $id
    ): ?array {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM procurement_requests
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $request = $stmt->fetch();

        return $request ?: null;
    }

    public function getItems(
        int $requestId
    ): array {

        $stmt = $this->pdo->prepare("
            SELECT *
            FROM procurement_request_items
            WHERE request_id = :request_id
            ORDER BY id ASC
        ");

        $stmt->execute([
            ':request_id' => $requestId
        ]);

        return $stmt->fetchAll();
    }

    public function generateRequestNumber(): string
    {
        $year = date('Y');

        $stmt = $this->pdo->query("
            SELECT request_number
            FROM procurement_requests
            ORDER BY id DESC
            LIMIT 1
        ");

        $last = $stmt->fetchColumn();

        if (!$last) {
            return 'PR-' . $year . '-0001';
        }

        $number = (int)substr(
            $last,
            -4
        );

        $number++;

        return sprintf(
            'PR-%s-%04d',
            $year,
            $number
        );
    }

    public function create(
        array $data
    ): int {

        $stmt = $this->pdo->prepare("
            INSERT INTO procurement_requests
            (
                request_number,
                requester_id,
                title,
                description,
                justification,
                estimated_total,
                priority,
                status,
                required_date,
                submitted_at
            )
            VALUES
            (
                :request_number,
                :requester_id,
                :title,
                :description,
                :justification,
                :estimated_total,
                :priority,
                :status,
                :required_date,
                NULL
            )
        ");

        $stmt->execute([
            ':request_number' => $data['request_number'],
            ':requester_id' => $data['requester_id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':justification' => $data['justification'],
            ':estimated_total' => $data['estimated_total'],
            ':priority' => $data['priority'],
            ':status' => $data['status'],
            ':required_date' => $data['required_date']
        ]);

        return (int)$this->pdo->lastInsertId();
    }

    public function createItem(
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            INSERT INTO procurement_request_items
            (
                request_id,
                item_name,
                description,
                quantity,
                unit_of_measure,
                estimated_unit_price,
                estimated_total_price,
                inventory_item_id
            )
            VALUES
            (
                :request_id,
                :item_name,
                :description,
                :quantity,
                :unit_of_measure,
                :estimated_unit_price,
                :estimated_total_price,
                :inventory_item_id
            )
        ");

        return $stmt->execute([
            ':request_id' => $data['request_id'],
            ':item_name' => $data['item_name'],
            ':description' => $data['description'],
            ':quantity' => $data['quantity'],
            ':unit_of_measure' => $data['unit_of_measure'],
            ':estimated_unit_price' => $data['estimated_unit_price'],
            ':estimated_total_price' => $data['estimated_total_price'],
            ':inventory_item_id' => $data['inventory_item_id']
        ]);
    }

    public function updateEstimatedTotal(
    int $requestId
    ): void {

    $stmt = $this->pdo->prepare("
        SELECT
            COALESCE(
                SUM(estimated_total_price),
                0
            )
        FROM procurement_request_items
        WHERE request_id = :request_id
    ");

    $stmt->execute([
        ':request_id' => $requestId
    ]);

    $total = (float)
        $stmt->fetchColumn();

    $update = $this->pdo->prepare("
        UPDATE procurement_requests
        SET estimated_total = :total
        WHERE id = :id
    ");

    $update->execute([
        ':total' => $total,
        ':id' => $requestId
    ]);

    }

    public function submit(
    int $requestId
    ): bool {

    $stmt = $this->pdo->prepare("
        UPDATE procurement_requests
        SET
            status = 'pending',
            submitted_at = NOW()
        WHERE id = :id
        AND status = 'draft'
    ");

    return $stmt->execute([':id' => $requestId]);
    }

    public function update(
        int $id,
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            UPDATE procurement_requests
            SET
                title = :title,
                description = :description,
                justification = :justification,
                priority = :priority,
                required_date = :required_date
            WHERE id = :id
            AND status = 'draft'
        ");

        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':justification' => $data['justification'],
            ':priority' => $data['priority'],
            ':required_date' => $data['required_date']
        ]);
    }

    public function delete(
        int $id
    ): bool {

        $stmt = $this->pdo->prepare("
            DELETE
            FROM procurement_requests
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }

}
