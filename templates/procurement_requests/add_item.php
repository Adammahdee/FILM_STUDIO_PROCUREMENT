<!DOCTYPE html>

<html>

<head>
    <title>Add Request Item</title>
</head>

<body>

<h1>Add Request Item</h1>

<p>

<a href="?page=procurement_request_view&id=<?= (int)($requestId ?? 0) ?>">

Back to Request

</a>

</p>

<?php if (!empty($error)): ?>

<p style="color:red;">

<?= htmlspecialchars($error) ?>

</p>

<?php endif; ?>

<form method="post">

<p>

Inventory Item<br>

<select name="inventory_item_id">

<option value="">
Select Inventory Item
</option>

<?php foreach ($inventoryItems ?? [] as $item): ?>

<option value="<?= $item['id'] ?>">

<?= htmlspecialchars(
    $item['name']
) ?>

</option>

<?php endforeach; ?>

</select>

</p>

<p>

Item Name<br>

<input
type="text"
name="item_name"
required

>

</p>

<p>

Description<br>

<textarea
    name="description"
    rows="4"
    cols="50"
></textarea>

</p>

<p>

Quantity<br>

<input
type="number"
min="1"
name="quantity"
required

>

</p>

<p>

Unit Of Measure<br>

<input
type="text"
name="unit_of_measure"
value="pcs"

>

</p>

<p>

Estimated Unit Price<br>

<input
type="number"
min="0"
step="0.01"
name="estimated_unit_price"
required

>

</p>

<button type="submit">

Add Item

</button>

</form>

</body>

</html>
