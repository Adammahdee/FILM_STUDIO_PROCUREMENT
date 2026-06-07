<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Core\Auth;

class UserController
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

            header('Location: ?page=login');
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

        $userModel = new User(
            $this->pdo
        );

        $users = $userModel->getAll();

        require dirname(__DIR__, 2)
            . '/templates/users/index.php';
    }

    public function create(): void
    {
    $this->authorize();

    $userModel = new User(
        $this->pdo
    );

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = trim(
            $_POST['username'] ?? ''
        );

        $email = trim(
            $_POST['email'] ?? ''
        );

        $fullName = trim(
            $_POST['full_name'] ?? ''
        );

        $password = $_POST['password'] ?? '';

        $role = $_POST['role'] ?? '';

        $department = trim(
            $_POST['department'] ?? ''
        );

        $phone = trim(
            $_POST['phone'] ?? ''
        );

        if (
            strlen($password) < 8
        ) {

            $error =
                'Password must be at least 8 characters.';

        } elseif (
            $userModel->usernameExists(
                $username
            )
        ) {

            $error =
                'Username already exists.';

        } elseif (
            $userModel->emailExists(
                $email
            )
        ) {

            $error =
                'Email already exists.';

        } else {

            $userModel->create([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'full_name' => $fullName,
                'role' => $role,
                'department' => $department,
                'phone' => $phone
            ]);

            header(
                'Location: ?page=users'
            );

            exit();
        }
    }

    require dirname(__DIR__, 2)
        . '/templates/users/create.php';
    }

    public function edit(): void
    {
        $this->authorize();

        $id = (int)($_GET['id'] ?? 0);

        $userModel = new User(
            $this->pdo
        );

        $user = $userModel->findById(
            $id
        );

        if (!$user) {

            http_response_code(404);

            echo '<h1>User Not Found</h1>';

            exit();
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim(
                $_POST['email'] ?? ''
            );

            if (
                !filter_var(
                    $email,
                    FILTER_VALIDATE_EMAIL
                )
            ) {

                $error =
                    'Invalid email address.';

            } else {

                $userModel->update(
                    $id,
                    [
                        'full_name' =>
                            trim($_POST['full_name'] ?? ''),

                        'email' =>
                            $email,

                        'role' =>
                            $_POST['role'] ?? '',

                        'department' =>
                            trim($_POST['department'] ?? ''),

                        'phone' =>
                            trim($_POST['phone'] ?? '')
                    ]
                );

                header(
                    'Location: ?page=users'
                );

                exit();
            }
        }
        
        require dirname(__DIR__, 2)
            . '/templates/users/edit.php';
    }

    public function toggleActive(): void
    {
        $this->authorize();

        $id = (int)($_GET['id'] ?? 0);

        $userModel = new User($this->pdo);

        $user = $userModel->findById($id);

        if (!$user) {
            http_response_code(404);
            echo '<h1>User Not Found</h1>';
            exit();
        }

        if ($user['id'] == $_SESSION['user_id']) {
            header('Location: ?page=users');
            exit();
        }

        $newStatus = (int)$user['is_active'] === 1 ? 0 : 1;

        $userModel->setActive($id, $newStatus);

        header('Location: ?page=users');
        exit();
    }
}
