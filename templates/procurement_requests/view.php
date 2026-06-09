<!DOCTYPE html>

<html>

<head>
    <title>Procurement Request Details</title>
</head>

<body>
    <?php

/** @var array<string,mixed> $request */
/** @var array<int,array<string,mixed>> $items */

?>

<h1>Procurement Request Details</h1>

<p>

<a href="?page=procurement_requests">

Back to Requests

</a>

</p>

<p></p>
<?php if (($request['status'] ?? '') === 'draft'): ?>

|

<a href="?page=procurement_request_submit&id=<?= (int)$request['id'] ?>">

Submit Request

</a>

<?php endif; ?>

</p>


<h2>Request Information</h2>

<table border="1" cellpadding="8">

<tr>
    <th>Request Number</th>
    <td><?= htmlspecialchars($request['request_number'] ?? '') ?></td>
</tr>

<tr>
    <th>Title</th>
    <td><?= htmlspecialchars($request['title'] ?? '') ?></td>
</tr>

<tr>
    <th>Description</th>
    <td><?= nl2br(htmlspecialchars($request['description'] ?? '')) ?></td>
</tr>

<tr>
    <th>Justification</th>
    <td><?= nl2br(htmlspecialchars($request['justification'] ?? '')) ?></td>
</tr>

<tr>
    <th>Priority</th>
    <td><?= htmlspecialchars($request['priority'] ?? '') ?></td>
</tr>

<tr>
    <th>Status</th>
    <td><?= htmlspecialchars($request['status'] ?? '') ?></td>
</tr>

<tr>
    <th>Required Date</th>
    <td><?= htmlspecialchars($request['required_date'] ?? '') ?></td>
</tr>

<tr>
    <th>Estimated Total</th>
    <td><?= number_format((float)($request['estimated_total'] ?? 0), 2) ?></td>
</tr>

</table>

<h2>Request Items</h2>

<p>

<a href="?page=procurement_request_add_item&id=<?= (int)($request['id'] ?? 0) ?>">

Add Item

</a>

</p>

<table border="1" cellpadding="8">

<thead>

<tr>

<th>Item Name</th>
<th>Description</th>
<th>Quantity</th>
<th>Unit</th>
<th>Unit Price</th>
<th>Total</th>

</tr>

</thead>

<tbody>

<?php if (empty($items)): ?>

<tr>

<td colspan="6">

No items added yet.

</td>

</tr>

<?php else: ?>

<?php foreach ($items as $item): ?>

<tr>

<td><?= htmlspecialchars($item['item_name']) ?></td>

<td><?= htmlspecialchars($item['description'] ?? '') ?></td>

<td><?= $item['quantity'] ?></td>

<td><?= htmlspecialchars($item['unit_of_measure']) ?></td>

<td><?= number_format((float)$item['estimated_unit_price'], 2) ?></td>

<td><?= number_format((float)$item['estimated_total_price'], 2) ?></td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</tbody>

</table>

</body>

</html>
