<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Core\Auth;

class AuthController
{
    private \PDO $pdo;

    public function __construct(
        \PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function login(): void
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = trim(
                $_POST['login'] ?? ''
            );

            $password = $_POST['password'] ?? '';

            $userModel = new User(
                $this->pdo
            );

            $user = $userModel
                ->findByUsernameOrEmail(
                    $login
                );

            if (!$user) {

                $error =
                    'Invalid credentials.';

            } elseif (
                (int)$user['is_active'] !== 1
            ) {

                $error =
                    'Account is inactive.';

            } elseif (
                !password_verify(
                    $password,
                    $user['password_hash']
                )
            ) {

                $error =
                    'Invalid credentials.';

            } else {

                Auth::login($user);

                header(
                    'Location: ?page=dashboard'
                );

                exit();
            }
        }

        require dirname(__DIR__, 2)
            . '/templates/auth/login.php';
    }

    public function logout(): void
    {
        Auth::logout();

        header(
            'Location: ?page=login'
        );

        exit();
    }
}