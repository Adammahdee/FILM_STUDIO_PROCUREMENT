<!DOCTYPE html>

<html>

<head>
    <title>Inventory Management</title>
</head>

<body>

<h1>Inventory Management</h1>

<p>

<a href="?page=dashboard">
Dashboard
</a>

|

<a href="?page=inventory_create">
Create Item
</a>

</p>

<table border="1" cellpadding="8">

<thead>

    <tr>

        <th>ID</th>
        <th>Item Code</th>
        <th>Name</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Unit Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th>Actions</th>

    </tr>

</thead>

<tbody>

<?php foreach ($items ?? [] as $item): ?>

    <tr>

        <td><?= $item['id'] ?></td>

        <td>
            <?= htmlspecialchars(
                $item['item_code']
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $item['name']
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $item['category_name'] ?? ''
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $item['supplier_name'] ?? ''
            ) ?>
        </td>

        <td>
            <?= number_format(
                (float)$item['unit_price'],
                2
            ) ?>
        </td>

        <td>
            <?= $item['quantity_in_stock'] ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $item['status']
            ) ?>
        </td>

        <td>

            <a href="?page=inventory_edit&id=<?= $item['id'] ?>">
                Edit
            </a>

            |

            <a href="?page=inventory_status&id=<?= $item['id'] ?>&status=active">
                Active
            </a>

            |

            <a href="?page=inventory_status&id=<?= $item['id'] ?>&status=inactive">
                Inactive
            </a>

            |

            <a href="?page=inventory_status&id=<?= $item['id'] ?>&status=discontinued">
                Discontinued
            </a>

        </td>

    </tr>

<?php endforeach; ?>

</tbody>

</table>

</body>

</html>
