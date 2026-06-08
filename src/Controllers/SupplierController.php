<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Supplier;
use App\Core\Auth;


class SupplierController
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function authorize(): void
    {
        if (!Auth::check()) {
            header('Location: ?page=login');
            exit();
        }
    }

    public function index(): void
    {
        $this->authorize();

        $supplierModel = new Supplier($this->pdo);
        $suppliers = $supplierModel->getAll();

        require dirname(__DIR__, 2)
            . '/templates/suppliers/index.php';
    }

public function create(): void
{
$this->authorize();

$supplierModel = new Supplier(
    $this->pdo
);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $companyName = trim(
        $_POST['company_name'] ?? ''
    );

    $email = trim(
        $_POST['email'] ?? ''
    );

    $rating = (float)(
        $_POST['rating'] ?? 0
    );

    if ($companyName === '') {

        $error =
            'Company name is required.';

    } elseif (
        $supplierModel->companyExists(
            $companyName
        )
    ) {

        $error =
            'Company already exists.';

    } elseif (
        $email !== ''
        &&
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $error =
            'Invalid email address.';

    } elseif (
        $rating < 0
        ||
        $rating > 5
    ) {

        $error =
            'Rating must be between 0 and 5.';
    } else {

        $supplierModel->create([
            'company_name' =>
                $companyName,

            'contact_person' =>
                trim($_POST['contact_person'] ?? ''),

            'email' =>
                $email,

            'phone' =>
                trim($_POST['phone'] ?? ''),

            'address' =>
                trim($_POST['address'] ?? ''),

            'website' =>
                trim($_POST['website'] ?? ''),

            'tax_id' =>
                trim($_POST['tax_id'] ?? ''),

            'payment_terms' =>
                trim($_POST['payment_terms'] ?? ''),

            'rating' =>
                $rating
        ]);

        header(
            'Location: ?page=suppliers'
        );

        exit();
    }
}

require dirname(__DIR__, 2)
    . '/templates/suppliers/create.php';
}

public function edit(): void
{
$this->authorize();

$id = (int)($_GET['id'] ?? 0);

$supplierModel = new Supplier(
    $this->pdo
);

$supplier = $supplierModel->findById(
    $id
);

if (!$supplier) {

    http_response_code(404);

    echo '<h1>Supplier Not Found</h1>';

    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim(
        $_POST['email'] ?? ''
    );

    $rating = (float)(
        $_POST['rating'] ?? 0
    );

    if (
        $email !== ''
        &&
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $error =
            'Invalid email address.';

    } elseif (
        $rating < 0
        ||
        $rating > 5
    ) {

        $error =
            'Rating must be between 0 and 5.';
    } else {

        $supplierModel->update(
            $id,
            [
                'company_name' =>
                    trim($_POST['company_name'] ?? ''),

                'contact_person' =>
                    trim($_POST['contact_person'] ?? ''),

                'email' =>
                    $email,

                'phone' =>
                    trim($_POST['phone'] ?? ''),

                'address' =>
                    trim($_POST['address'] ?? ''),

                'website' =>
                    trim($_POST['website'] ?? ''),

                'tax_id' =>
                    trim($_POST['tax_id'] ?? ''),

                'payment_terms' =>
                    trim($_POST['payment_terms'] ?? ''),

                'rating' =>
                    $rating
            ]
        );

        header(
            'Location: ?page=suppliers'
        );

        exit();
    }
}

require dirname(__DIR__, 2) . '/templates/suppliers/edit.php';
}

    public function toggleActive(): void
    {
        $this->authorize();
        $id = (int)($_GET['id'] ?? 0);
        $supplierModel = new Supplier($this->pdo);
        $supplier = $supplierModel->findById($id);
        if (!$supplier) {
            http_response_code(404);
            echo '<h1>Supplier Not Found</h1>';
            exit();
        }
        $newStatus = (int)$supplier['is_active'] === 1 ? 0 : 1;
        $supplierModel->setActive($id, $newStatus);
        header('Location: ?page=suppliers');
        exit();
    }
}