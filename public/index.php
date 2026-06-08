<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/db.php';

require_once dirname(__DIR__)
    . '/src/Core/Autoloader.php';

use App\Core\Session;
use App\Core\Auth;

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\SupplierController;

Session::start();

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'login':

        (new AuthController(
            $pdo
        ))->login();

        break;

    case 'logout':

        (new AuthController(
            $pdo
        ))->logout();

        break;

    case 'dashboard':

        if (!Auth::check()) {

            header(
                'Location: ?page=login'
            );

            exit();
        }

        require dirname(__DIR__)
            . '/templates/dashboard/index.php';

        break;

    case 'home':

        require dirname(__DIR__)
            . '/templates/home.php';

        break;

    case 'suppliers':

        (new SupplierController(
            $pdo
        ))->index();

        break;
    case 'suppliers_create':

        (new SupplierController(
            $pdo
        ))->create();

        break;
    case 'suppliers_edit':

        (new SupplierController(
            $pdo
        ))->edit();

        break;
    case 'suppliers_toggle':

        (new SupplierController(
            $pdo
        ))->toggleActive();

        break;

    case 'users/create':

        (new UserController(
            $pdo
        ))->create();

        break;
    
        case 'users/edit':

        (new UserController(
            $pdo
        ))->edit();

        break;

    case 'users_toggle':

    (new UserController(
        $pdo
    ))->toggleActive();

    break;

    case 'users':

        (new UserController(
            $pdo
        ))->index();

        break;

    default:

        http_response_code(404);

        echo '<h1>404 - Page Not Found</h1>';
}