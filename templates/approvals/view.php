<!DOCTYPE html>

<html>

<head>
    <title>Approval Details</title>
</head>

<body>

<h1>Approval Details</h1>

<p>

<a href="?page=approvals">

Back to Queue

</a>

</p>

<table border="1" cellpadding="8">

<tr>
    <th>Request Number</th>
    <td>
        <?= htmlspecialchars(
            $workflow['request_number']
        ) ?>
    </td>
</tr>

<tr>
    <th>Title</th>
    <td>
        <?= htmlspecialchars(
            $workflow['title']
        ) ?>
    </td>
</tr>

<tr>
    <th>Approval Level</th>
    <td>
        <?= $workflow['approval_level'] ?>
    </td>
</tr>

<tr>
    <th>Status</th>
    <td>
        <?= htmlspecialchars(
            $workflow['status']
        ) ?>
    </td>
</tr>

</table>

<h2>Workflow History</h2>

<table border="1" cellpadding="8">

<thead>

<tr>

    <th>Level</th>
    <th>Approver</th>
    <th>Status</th>
    <th>Comments</th>
    <th>Decision Date</th>

</tr>

</thead>

<tbody>

<?php foreach ($history as $item): ?>

<tr>

    <td>
        <?= $item['approval_level'] ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $item['full_name'] ?? ''
        ) ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $item['status']
        ) ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $item['comments'] ?? ''
        ) ?>
    </td>

    <td>
        <?= htmlspecialchars(
            $item['decided_at'] ?? ''
        ) ?>
    </td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?php if ($workflow['status'] === 'pending'): ?>

<h2>Approve Request</h2>

<form
    method="post"
    action="?page=approval_approve&id=<?= $workflow['id'] ?>"
>

    <textarea
        name="comments"
        rows="4"
        cols="60"
    ></textarea>

    <br><br>

    <button type="submit">

        Approve

    </button>

</form>

<h2>Reject Request</h2>

<form
    method="post"
    action="?page=approval_reject&id=<?= $workflow['id'] ?>"
>

    <textarea
        name="comments"
        rows="4"
        cols="60"
    ></textarea>

    <br><br>

    <button type="submit">

        Reject

    </button>

</form>

<?php endif; ?>

</body>

</html>