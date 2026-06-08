<!DOCTYPE html>

<html>

<head>
    <title>Supplier Management</title>
</head>

<body>

<h1>Supplier Management</h1>

<p>

<a href="?page=dashboard">
Dashboard
</a>

|

<a href="?page=suppliers_create">
Create Supplier
</a>

</p>

<table border="1" cellpadding="8">

<thead>

    <tr>

        <th>ID</th>
        <th>Company</th>
        <th>Contact Person</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Rating</th>
        <th>Status</th>
        <th>Actions</th>

    </tr>

</thead>

<tbody>

    <?php foreach ($suppliers ?? [] as $supplier): ?>

    <tr>

        <td>
            <?= $supplier['id'] ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $supplier['company_name']
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $supplier['contact_person'] ?? ''
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $supplier['email'] ?? ''
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $supplier['phone'] ?? ''
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $supplier['rating']
            ) ?>
        </td>

        <td>

            <?= (int)$supplier['is_active'] === 1
                ? 'Active'
                : 'Inactive'
            ?>

        </td>

        <td>

            <a href="?page=suppliers_edit&id=<?= $supplier['id'] ?>">

                Edit

            </a>

            |

            <a href="?page=suppliers_toggle&id=<?= $supplier['id'] ?>">

                <?= (int)$supplier['is_active'] === 1
                    ? 'Deactivate'
                    : 'Activate'
                ?>

            </a>

        </td>

    </tr>

    <?php endforeach; ?>

</tbody>

</table>

</body>

</html>
