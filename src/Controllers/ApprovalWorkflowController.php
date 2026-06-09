<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Models\ApprovalWorkflow;

class ApprovalWorkflowController
{
    private \PDO $pdo;

    public function __construct(
        \PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    private function authorize(): void
    {
        if (!Auth::check()) {

            header(
                'Location: ?page=login'
            );

            exit();
        }
    }

    private function canApprove(): bool
    {
        $role = Auth::role() ?? '';

        return in_array(
            $role,
            [
                'admin',
                'manager',
                'department_head'
            ],
            true
        );
    }

    public function index(): void
    {
        $this->authorize();

        if (!$this->canApprove()) {

            http_response_code(403);

            echo '<h1>Access Denied</h1>';

            exit();
        }

        $workflowModel =
            new ApprovalWorkflow(
                $this->pdo
            );

        $approvals =
            $workflowModel
                ->getPendingApprovals(
                    $_SESSION['role']
                );

        require dirname(__DIR__, 2)
            . '/templates/approvals/index.php';
    }

    public function view(): void
    {
        $this->authorize();

        if (!$this->canApprove()) {

            http_response_code(403);

            echo '<h1>Access Denied</h1>';

            exit();
        }

        $id = (int)(
            $_GET['id'] ?? 0
        );

        $workflowModel =
            new ApprovalWorkflow(
                $this->pdo
            );

        $workflow =
            $workflowModel
                ->findById($id);

        if (!$workflow) {

            http_response_code(404);

            echo '<h1>Workflow Not Found</h1>';

            exit();
        }

        $history =
            $workflowModel
                ->getWorkflowHistory(
                    (int)$workflow['request_id']
                );

        require dirname(__DIR__, 2)
            . '/templates/approvals/view.php';
    }

    public function approve(): void
    {
        $this->authorize();

        if (!$this->canApprove()) {

            http_response_code(403);

            echo '<h1>Access Denied</h1>';

            exit();
        }

        $workflowId = (int)(
            $_GET['id'] ?? 0
        );

        $comments = trim(
            $_POST['comments'] ?? ''
        );

        $workflowModel =
            new ApprovalWorkflow(
                $this->pdo
            );

        $workflow =
            $workflowModel
                ->findById(
                    $workflowId
                );

        if (!$workflow) {

            http_response_code(404);

            echo '<h1>Workflow Not Found</h1>';

            exit();
        }

        try {

            $this->pdo->beginTransaction();

            $updateWorkflow =
                $this->pdo->prepare("
                    UPDATE approval_workflows
                    SET
                        status = 'approved',
                        comments = :comments,
                        decided_at = NOW()
                    WHERE id = :id
                ");

            $updateWorkflow->execute([
                ':comments' => $comments,
                ':id' => $workflowId
            ]);

            $requestId =
                (int)$workflow['request_id'];

            $level =
                (int)$workflow['approval_level'];

            if ($level === 1) {

                $managerId =
                    $workflowModel
                        ->getFirstUserByRole(
                            'manager'
                        );

                if (!$managerId) {

                    throw new \RuntimeException(
                        'No active manager found.'
                    );
                }

                $requestUpdate =
                    $this->pdo->prepare("
                        UPDATE procurement_requests
                        SET status = 'under_review'
                        WHERE id = :id
                    ");

                $requestUpdate->execute([
                    ':id' => $requestId
                ]);

                $workflowModel
                    ->createWorkflow([
                        'request_id' => $requestId,
                        'approver_id' => $managerId,
                        'approval_level' => 2
                    ]);

            } else {

                $requestUpdate =
                    $this->pdo->prepare("
                        UPDATE procurement_requests
                        SET status = 'approved'
                        WHERE id = :id
                    ");

                $requestUpdate->execute([
                    ':id' => $requestId
                ]);
            }

            $this->pdo->commit();

        } catch (\Throwable $e) {

            $this->pdo->rollBack();

            throw $e;
        }

        header(
            'Location: ?page=approvals'
        );

        exit();
    }

    public function reject(): void
    {
        $this->authorize();

        if (!$this->canApprove()) {

            http_response_code(403);

            echo '<h1>Access Denied</h1>';

            exit();
        }

        $workflowId = (int)(
            $_GET['id'] ?? 0
        );

        $comments = trim(
            $_POST['comments'] ?? ''
        );

        $workflowModel =
            new ApprovalWorkflow(
                $this->pdo
            );

        $workflow =
            $workflowModel
                ->findById(
                    $workflowId
                );

        if (!$workflow) {

            http_response_code(404);

            echo '<h1>Workflow Not Found</h1>';

            exit();
        }

        try {

            $this->pdo->beginTransaction();

            $updateWorkflow =
                $this->pdo->prepare("
                    UPDATE approval_workflows
                    SET
                        status = 'rejected',
                        comments = :comments,
                        decided_at = NOW()
                    WHERE id = :id
                ");

            $updateWorkflow->execute([
                ':comments' => $comments,
                ':id' => $workflowId
            ]);

            $requestUpdate =
                $this->pdo->prepare("
                    UPDATE procurement_requests
                    SET status = 'rejected'
                    WHERE id = :id
                ");

            $requestUpdate->execute([
                ':id' => $workflow['request_id']
            ]);

            $this->pdo->commit();

        } catch (\Throwable $e) {

            $this->pdo->rollBack();

            throw $e;
        }

        header(
            'Location: ?page=approvals'
        );

        exit();
    }
}