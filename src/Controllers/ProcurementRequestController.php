<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Models\ProcurementRequest;

class ProcurementRequestController
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

    public function index(): void
    {
        $this->authorize();

        $requestModel =
            new ProcurementRequest(
                $this->pdo
            );

        $requests =
            $requestModel->getAll();

        require dirname(__DIR__, 2)
            . '/templates/procurement_requests/index.php';
    }

    public function create(): void
    {
    $this->authorize();

    $requestModel =
        new ProcurementRequest(
            $this->pdo
        );

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title = trim(
            $_POST['title'] ?? ''
        );

        if ($title === '') {

            $error =
                'Title is required.';
        } else {

            $requestNumber =
                $requestModel
                    ->generateRequestNumber();

            $requestModel->create([

                'request_number' =>
                    $requestNumber,

                'requester_id' =>
                    $_SESSION['user_id'],

                'title' =>
                    $title,

                'description' =>
                    trim(
                        $_POST['description'] ?? ''
                    ),

                'justification' =>
                    trim(
                        $_POST['justification'] ?? ''
                    ),

                'estimated_total' =>
                    0,

                'priority' =>
                    $_POST['priority'] ?? 'medium',

                'status' =>
                    'draft',

                'required_date' =>
                    $_POST['required_date'] ?: null
            ]);

            header(
                'Location: ?page=procurement_requests'
            );

            exit();
        }
    }

    require dirname(__DIR__, 2)
        . '/templates/procurement_requests/create.php';

    }
    public function edit(): void
    {
    $this->authorize();
    $id = (int)($_GET['id'] ?? 0);

    $requestModel = new ProcurementRequest($this->pdo);
    $request = $requestModel->findById($id);

    if (!$request) {
        header('Location: ?page=procurement_requests');
        exit();
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');

        if ($title === '') {
            $error = 'Title is required.';
        } else {
            $updateStmt = $this->pdo->prepare("
                UPDATE procurement_requests
                SET
                    title = :title,
                    description = :description,
                    justification = :justification,
                    priority = :priority,
                    required_date = :required_date
                WHERE id = :id
            ");

            $updateStmt->execute([
                ':title' => $title,
                ':description' => trim($_POST['description'] ?? ''),
                ':justification' => trim($_POST['justification'] ?? ''),
                ':priority' => $_POST['priority'] ?? 'medium',
                ':required_date' => $_POST['required_date'] ?: null,
                ':id' => $id
            ]);

            header('Location: ?page=procurement_request_view&id=' . $id);
            exit();
        }
    }

    require dirname(__DIR__, 2) . '/templates/procurement_requests/edit.php';
    }

    public function view(): void
    {
        $this->authorize();
        
        $id = (int)($_GET['id'] ?? 0);

        $requestModel =
            new ProcurementRequest(
                $this->pdo
            );

        $request =
            $requestModel->findById($id);

        if (!$request) {

            header(
                'Location: ?page=procurement_requests'
            );

            exit();
        }

        $items =
            $requestModel->getItems($id);

        require dirname(__DIR__, 2)
            . '/templates/procurement_requests/view.php';
    }

    public function updateEstimatedTotal(
        int $requestId
    ): void {

        $stmt = $this->pdo->prepare("
        SELECT SUM(
            quantity * estimated_unit_price
        ) AS total
        FROM procurement_request_items
        WHERE request_id = :request_id
    ");
        $stmt->execute([':request_id' => $requestId]);

        $total = $stmt->fetchColumn();

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
    public function delete(): void
    {
        $this->authorize();

        $id = (int)($_GET['id'] ?? 0);

        $requestModel =
            new ProcurementRequest(
                $this->pdo
            );

        $request =
            $requestModel->findById($id);

        if (!$request) {

            header(
                'Location: ?page=procurement_requests'
            );

            exit();
        }

        if (
            ($request['status'] ?? '')
            !== 'draft'
        ) {

            echo
            '<h1>Only draft requests can be deleted.</h1>';

            exit();
        }

        $stmt = $this->pdo->prepare("
            DELETE FROM procurement_requests 
            WHERE id = :id 
            AND status = 'draft'
        ");
        $stmt->execute([':id' => $id]);

        header(
            'Location: ?page=procurement_requests'
        );

        exit();
    }

    public function addItem(): void
    {
    $this->authorize();

    $requestId = (int)(
        $_GET['id'] ?? 0
    );

    $requestModel =
        new ProcurementRequest(
            $this->pdo
        );

    $request =
        $requestModel->findById(
            $requestId
        );

    if (!$request) {

        http_response_code(404);

        echo '<h1>Request Not Found</h1>';

        exit();
    }

    $inventoryModel =
        new \App\Models\InventoryItem(
            $this->pdo
        );

    $inventoryItems =
        $inventoryModel->getAll();

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $quantity = (int)(
            $_POST['quantity'] ?? 0
        );

        $unitPrice = (float)(
            $_POST['estimated_unit_price'] ?? 0
        );

        if ($quantity <= 0) {

            $error =
                'Quantity must be greater than zero.';

        } elseif ($unitPrice < 0) {

            $error =
                'Unit price cannot be negative.';
        } else {

            $total =
                $quantity * $unitPrice;

            $requestModel->createItem([

                'request_id' =>
                    $requestId,

                'item_name' =>
                    trim($_POST['item_name'] ?? ''),

                'description' =>
                    trim($_POST['description'] ?? ''),

                'quantity' =>
                    $quantity,

                'unit_of_measure' =>
                    trim($_POST['unit_of_measure'] ?? 'pcs'),

                'estimated_unit_price' =>
                    $unitPrice,

                'estimated_total_price' =>
                    $total,

                'inventory_item_id' =>
                    $_POST['inventory_item_id'] ?: null
            ]);

            $requestModel
                ->updateEstimatedTotal(
                    $requestId
                );

            header(
                'Location: ?page=procurement_request_view&id='
                . $requestId
            );

            exit();
        }
    }

    require dirname(__DIR__, 2)
        . '/templates/procurement_requests/add_item.php';

    }

    public function submit(): void
    {
    $this->authorize();

    $id = (int)(
        $_GET['id'] ?? 0
    );

    $requestModel =
        new ProcurementRequest(
            $this->pdo
        );

    $request =
        $requestModel->findById(
            $id
        );

    if (!$request) {

        http_response_code(404);

        echo '<h1>Request Not Found</h1>';

        exit();
    }

    $items =
        $requestModel->getItems(
            $id
        );

    if (empty($items)) {

        echo
        '<h1>Cannot submit a request without items.</h1>';

        exit();
    }

    $requestModel->submit(
        $id
    );

    header(
        'Location: ?page=procurement_request_view&id='
        . $id
    );

    exit();

    }

}