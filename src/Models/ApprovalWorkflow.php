<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class ApprovalWorkflow
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function getPendingApprovals(
        string $role
    ): array {

        if ($role === 'admin') {

            $stmt = $this->pdo->query("
                SELECT
                    aw.*,
                    pr.request_number,
                    pr.title
                FROM approval_workflows aw
                INNER JOIN procurement_requests pr
                    ON pr.id = aw.request_id
                WHERE aw.status = 'pending'
                ORDER BY aw.created_at ASC
            ");

            return $stmt->fetchAll();
        }

        $stmt = $this->pdo->prepare("
            SELECT
                aw.*,
                pr.request_number,
                pr.title
            FROM approval_workflows aw
            INNER JOIN procurement_requests pr
                ON pr.id = aw.request_id
            INNER JOIN users u
                ON u.id = aw.approver_id
            WHERE aw.status = 'pending'
            AND u.role = :role
            ORDER BY aw.created_at ASC
        ");

        $stmt->execute([
            ':role' => $role
        ]);

        return $stmt->fetchAll();
    }

    public function findById(
        int $id
    ): ?array {

        $stmt = $this->pdo->prepare("
            SELECT
                aw.*,
                pr.request_number,
                pr.title
            FROM approval_workflows aw
            INNER JOIN procurement_requests pr
                ON pr.id = aw.request_id
            WHERE aw.id = :id
            LIMIT 1
        ");

        $stmt->execute([
            ':id' => $id
        ]);

        $workflow = $stmt->fetch();

        return $workflow ?: null;
    }

    public function getWorkflowHistory(
        int $requestId
    ): array {

        $stmt = $this->pdo->prepare("
            SELECT
                aw.*,
                u.full_name
            FROM approval_workflows aw
            LEFT JOIN users u
                ON u.id = aw.approver_id
            WHERE aw.request_id = :request_id
            ORDER BY aw.approval_level ASC
        ");

        $stmt->execute([
            ':request_id' => $requestId
        ]);

        return $stmt->fetchAll();
    }

    public function createWorkflow(
        array $data
    ): bool {

        $stmt = $this->pdo->prepare("
            INSERT INTO approval_workflows
            (
                request_id,
                approver_id,
                approval_level,
                status,
                comments
            )
            VALUES
            (
                :request_id,
                :approver_id,
                :approval_level,
                'pending',
                NULL
            )
        ");

        return $stmt->execute([
            ':request_id' => $data['request_id'],
            ':approver_id' => $data['approver_id'],
            ':approval_level' => $data['approval_level']
        ]);
    }

    public function getFirstUserByRole(
        string $role
    ): ?int {

        $stmt = $this->pdo->prepare("
            SELECT id
            FROM users
            WHERE role = :role
            AND is_active = 1
            LIMIT 1
        ");

        $stmt->execute([
            ':role' => $role
        ]);

        $id = $stmt->fetchColumn();

        return $id ? (int)$id : null;
    }
}