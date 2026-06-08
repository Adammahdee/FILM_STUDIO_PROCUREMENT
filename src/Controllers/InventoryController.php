<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Models\InventoryItem;

class InventoryController
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

        $inventoryModel = new InventoryItem(
            $this->pdo
        );

        $items = $inventoryModel->getAll();

        require dirname(__DIR__, 2)
            . '/templates/inventory/index.php';
    }

    public function create(): void
    {
    $this->authorize();

    $inventoryModel = new InventoryItem(
        $this->pdo
    );

    $categories =
        $inventoryModel->getCategories();

    $suppliers =
        $inventoryModel->getSuppliers();

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $itemCode = trim(
            $_POST['item_code'] ?? ''
        );

        $name = trim(
            $_POST['name'] ?? ''
        );

        $unitPrice = (float)(
            $_POST['unit_price'] ?? 0
        );

        $stock = (int)(
            $_POST['quantity_in_stock'] ?? 0
        );

        $reorderLevel = (int)(
            $_POST['reorder_level'] ?? 0
        );

        if ($itemCode === '') {

            $error =
                'Item code is required.';

        } elseif (
            $inventoryModel->itemCodeExists(
                $itemCode
            )
        ) {

            $error =
                'Item code already exists.';

        } elseif ($name === '') {

            $error =
                'Item name is required.';

        } elseif ($unitPrice < 0) {

            $error =
                'Unit price cannot be negative.';

        } elseif ($stock < 0) {

            $error =
                'Stock quantity cannot be negative.';

        } elseif ($reorderLevel < 0) {

            $error =
                'Reorder level cannot be negative.';
        } else {

            $inventoryModel->create([

                'item_code' =>
                    $itemCode,

                'name' =>
                    $name,

                'description' =>
                    trim($_POST['description'] ?? ''),

                'category_id' =>
                    $_POST['category_id'] ?: null,

                'supplier_id' =>
                    $_POST['supplier_id'] ?: null,

                'unit_of_measure' =>
                    trim($_POST['unit_of_measure'] ?? 'pcs'),

                'unit_price' =>
                    $unitPrice,

                'quantity_in_stock' =>
                    $stock,

                'reorder_level' =>
                    $reorderLevel,

                'reorder_quantity' =>
                    (int)(
                        $_POST['reorder_quantity'] ?? 50
                    ),

                'location' =>
                    trim($_POST['location'] ?? ''),

                'status' =>
                    $_POST['status'] ?? 'active'
            ]);

            header(
                'Location: ?page=inventory'
            );

            exit();
        }
    }

    require dirname(__DIR__, 2)
        . '/templates/inventory/create.php';

    }

    public function edit(): void
    {
    $this->authorize();
    $id = (int)($_GET['id'] ?? 0);

    $inventoryModel = new InventoryItem(
        $this->pdo
    );

    $item = $inventoryModel->findById(
        $id
    );

    if (!$item) {

        http_response_code(404);

        echo '<h1>Inventory Item Not Found</h1>';

        exit();
    }

    $categories =
        $inventoryModel->getCategories();

    $suppliers =
        $inventoryModel->getSuppliers();

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $unitPrice = (float)(
            $_POST['unit_price'] ?? 0
        );

        $stock = (int)(
            $_POST['quantity_in_stock'] ?? 0
        );

        $reorderLevel = (int)(
            $_POST['reorder_level'] ?? 0
        );

        if ($unitPrice < 0) {

            $error =
                'Unit price cannot be negative.';

        } elseif ($stock < 0) {

            $error =
                'Stock quantity cannot be negative.';

        } elseif ($reorderLevel < 0) {

            $error =
                'Reorder level cannot be negative.';
        } else {

            $inventoryModel->update(
                $id,
                [
                    'item_code' =>
                        trim($_POST['item_code'] ?? ''),

                    'name' =>
                        trim($_POST['name'] ?? ''),

                    'description' =>
                        trim($_POST['description'] ?? ''),

                    'category_id' =>
                        $_POST['category_id'] ?: null,

                    'supplier_id' =>
                        $_POST['supplier_id'] ?: null,

                    'unit_of_measure' =>
                        trim($_POST['unit_of_measure'] ?? 'pcs'),

                    'unit_price' =>
                        $unitPrice,

                    'quantity_in_stock' =>
                        $stock,

                    'reorder_level' =>
                        $reorderLevel,

                    'reorder_quantity' =>
                        (int)(
                            $_POST['reorder_quantity'] ?? 50
                        ),

                    'location' =>
                        trim($_POST['location'] ?? ''),

                    'status' =>
                        $_POST['status'] ?? 'active'
                ]
            );

            header(
                'Location: ?page=inventory'
            );

            exit();
        }
    }

    require dirname(__DIR__, 2)
        . '/templates/inventory/edit.php';

    }

    public function changeStatus(): void
    {
    $this->authorize();

    $id = (int)($_GET['id'] ?? 0);

    $status = $_GET['status'] ?? '';

    $allowedStatuses = [
        'active',
        'inactive',
        'discontinued'
    ];

    if (
        !in_array(
            $status,
            $allowedStatuses,
            true
        )
    ) {

        http_response_code(400);

        echo '<h1>Invalid Status</h1>';

        exit();
    }

    $inventoryModel = new InventoryItem(
        $this->pdo
    );

    $item = $inventoryModel->findById(
        $id
    );

    if (!$item) {

        http_response_code(404);

        echo '<h1>Inventory Item Not Found</h1>';

        exit();
    }

    $inventoryModel->setStatus(
        $id,
        $status
    );

    header(
        'Location: ?page=inventory'
    );

    exit();

    }
}