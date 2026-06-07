<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Supplier;
use App\Core\Auth;

class SupplierController
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

        if (!Auth::hasRole('admin')) {

            http_response_code(403);

            echo '<h1>403 - Access Denied</h1>';

            exit();
        }
    }

    public function index(): void
    {
        $this->authorize();

        $supplierModel = new Supplier(
            $this->pdo
        );

        $suppliers =
            $supplierModel->getAll();

        require dirname(__DIR__, 2)
            . '/templates/suppliers/index.php';
    }
}
