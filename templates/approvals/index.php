<!DOCTYPE html>

<html>

<head>
    <title>Approval Queue</title>
</head>

<body>

<h1>Approval Queue</h1>

<p>

<a href="?page=dashboard">
Dashboard
</a>

</p>

<table border="1" cellpadding="8">

<thead>

<tr>

    <th>ID</th>
    <th>Request Number</th>
    <th>Title</th>
    <th>Level</th>
    <th>Status</th>
    <th>Actions</th>

</tr>

</thead>

<tbody>

<?php foreach ($approvals ?? [] as $approval): ?>

<tr>

    <td>
        <?= $approval['id'] ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $approval['request_number']
        ) ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $approval['title']
        ) ?>
    </td>

    <td>
        <?= $approval['approval_level'] ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $approval['status']
        ) ?>
    </td>

    <td>

        <a href="?page=approval_view&id=<?= $approval['id'] ?>">

            View

        </a>

    </td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</body>

</html>