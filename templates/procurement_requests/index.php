<!DOCTYPE html>

<html>

<head>
    <title>Procurement Requests</title>
</head>

<body>

<h1>Procurement Requests</h1>

<p>

<a href="?page=dashboard">

Dashboard

</a>

|

<a href="?page=procurement_request_create">

Create Request

</a>

</p>

<table border="1" cellpadding="8">

<thead>

    <tr>

        <th>ID</th>
        <th>Request Number</th>
        <th>Title</th>
        <th>Requester</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Required Date</th>
        <th>Estimated Total</th>
        <th>Actions</th>

    </tr>

</thead>

<tbody>

<?php foreach ($requests ?? [] as $request): ?>

    <tr>

        <td><?= $request['id'] ?></td>

        <td>
            <?= htmlspecialchars(
                $request['request_number']
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $request['title']
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $request['requester_name'] ?? ''
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $request['priority']
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $request['status']
            ) ?>
        </td>

        <td>
            <?= htmlspecialchars(
                $request['required_date']
            ) ?>
        </td>

        <td>
            <?= number_format(
                (float)$request['estimated_total'],
                2
            ) ?>
        </td>

        <td>

            <a href="?page=procurement_request_view&id=<?= $request['id'] ?>">
                View
            </a>

            <?php if (
                ($request['status'] ?? '') === 'draft'
            ): ?>

            |

            <a href="?page=procurement_request_edit&id=<?= $request['id'] ?>">
                Edit
            </a>

            |

            <a
                href="?page=procurement_request_delete&id=<?= $request['id'] ?>"
                onclick="return confirm('Delete this request?');"
            >
                Delete
            </a>

            <?php endif; ?>

            </td>

        </td>

    </tr>

<?php endforeach; ?>

</tbody>

</table>

</body>

</html>
