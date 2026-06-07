<!DOCTYPE html>

<html>

<head>
    <title>User Management</title>
</head>

<body>

<h1>User Management</h1>

<p>

<a href="?page=dashboard">
Dashboard
</a>

</p>

<p>

<a href="?page=users/create">
Create User
</a>
</p>

<p>

<a href="?page=users">
View Users
</a>

</p>

<p>

<a href="?page=logout">
Logout
</a>

</p>

<table border="1" cellpadding="8">

<thead>

    <tr>

        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Department</th>
        <th>Status</th>

    </tr>

</thead>

<tbody>

    <?php foreach ($users ?? [] as $user): ?>

    <tr>

        <td>
            <?= $user['id'] ?>
        </td>

        <td>
            <?= htmlspecialchars($user['username']) ?>
        </td>

        <td>
            <?= htmlspecialchars($user['full_name']) ?>
        </td>

        <td>
            <?= htmlspecialchars($user['email']) ?>
        </td>

        <td>
            <?= htmlspecialchars($user['role']) ?>
        </td>

        <td>
            <?= htmlspecialchars($user['department'] ?? '') ?>
        </td>

        <td>

            <?= (int)$user['is_active'] === 1
                ? 'Active'
                : 'Inactive'
            ?>

        </td>

    </tr>

<td>

    <a href="?page=users_edit&id=<?= $user['id'] ?>">

        Edit

    </a>

    |

    <?php if (
        $user['id']
        != ($_SESSION['user_id'] ?? 0)
    ): ?>

        <a href="?page=users_toggle&id=<?= $user['id'] ?>">

            <?= (int)$user['is_active'] === 1
                ? 'Deactivate'
                : 'Activate'
            ?>

        </a>

    <?php endif; ?>

</td>

</td>

    <?php endforeach; ?>

</tbody>

</table>

</body>

</html>
