<?php

declare(strict_types=1);

namespace App\Core;

class Auth
{
    public static function login(array $user): void
    {
        Session::regenerate();

        $_SESSION['user_id'] = $user['id'];

        $_SESSION['username'] = $user['username'];

        $_SESSION['full_name'] = $user['full_name'];

        $_SESSION['role'] = $user['role'];
    }

    public static function logout(): void
    {
        Session::destroy();
    }

    public static function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public static function id(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }

    public static function role(): ?string
    {
        return $_SESSION['role'] ?? null;
    }

    public static function user(): array|null
    {
        if (!self::check()) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'full_name' => $_SESSION['full_name'],
            'role' => $_SESSION['role']
        ];
    }

    public static function hasRole(
        string|array $roles
    ): bool {

        if (!self::check()) {
            return false;
        }

        $currentRole = $_SESSION['role'];

        if (is_array($roles)) {
            return in_array(
                $currentRole,
                $roles,
                true
            );
        }

        return $currentRole === $roles;
    }
}