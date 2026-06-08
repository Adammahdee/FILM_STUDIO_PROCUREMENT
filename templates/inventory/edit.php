<!DOCTYPE html>

<html>

<head>
    <title>Edit Inventory Item</title>
</head>

<body>

<h1>Edit Inventory Item</h1>

<p>

<a href="?page=inventory">

Back to Inventory

</a>

</p>

<?php if (!empty($error)): ?>

<p style="color:red;">

<?= htmlspecialchars($error) ?>

</p>

<?php endif; ?>

<form method="post">

<p>
    Item Code<br>
    <input
        type="text"
        name="item_code"
        value="<?= htmlspecialchars($item['item_code'] ?? '') ?>"
        required
    >
</p>

<p>
    Item Name<br>
    <input
        type="text"
        name="name"
        value="<?= htmlspecialchars($item['name'] ?? '') ?>"
        required
    >
</p>

<p>
    Description<br>
    <textarea
        name="description"
        rows="4"
        cols="50"
    ><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
</p>

<p>
    Category<br>

    <select name="category_id">

        <option value="">
            Select Category
        </option>

        <?php foreach ($categories ?? [] as $category): ?>

            <option
                value="<?= $category['id'] ?>"
                <?= (int)($item['category_id'] ?? 0) === (int)$category['id']
                    ? 'selected'
                    : '' ?>
            >

                <?= htmlspecialchars(
                    $category['name']
                ) ?>

            </option>

        <?php endforeach; ?>

    </select>

</p>

<p>
    Supplier<br>

    <select name="supplier_id">

        <option value="">
            Select Supplier
        </option>

        <?php foreach ($suppliers ?? [] as $supplier): ?>

            <option
                value="<?= $supplier['id'] ?>"
                <?= (int)($item['supplier_id'] ?? 0) === (int)$supplier['id']
                    ? 'selected'
                    : '' ?>
            >

                <?= htmlspecialchars(
                    $supplier['company_name']
                ) ?>

            </option>

        <?php endforeach; ?>

    </select>

</p>

<p>
    Unit Of Measure<br>
    <input
        type="text"
        name="unit_of_measure"
        value="<?= htmlspecialchars($item['unit_of_measure'] ?? '') ?>"
    >
</p>

<p>
    Unit Price<br>
    <input
        type="number"
        step="0.01"
        min="0"
        name="unit_price"
        value="<?= htmlspecialchars((string)($item['unit_price'] ?? 0)) ?>"
    >
</p>

<p>
    Quantity In Stock<br>
    <input
        type="number"
        min="0"
        name="quantity_in_stock"
        value="<?= htmlspecialchars((string)($item['quantity_in_stock'] ?? 0)) ?>"
    >
</p>

<p>
    Reorder Level<br>
    <input
        type="number"
        min="0"
        name="reorder_level"
        value="<?= htmlspecialchars((string)($item['reorder_level'] ?? 0)) ?>"
    >
</p>

<p>
    Reorder Quantity<br>
    <input
        type="number"
        min="0"
        name="reorder_quantity"
        value="<?= htmlspecialchars((string)($item['reorder_quantity'] ?? 0)) ?>"
    >
</p>

<p>
    Location<br>
    <input
        type="text"
        name="location"
        value="<?= htmlspecialchars($item['location'] ?? '') ?>"
    >
</p>

<p>
    Status<br>

    <select name="status">

        <option
            value="active"
            <?= ($item['status'] ?? '') === 'active'
                ? 'selected'
                : '' ?>
        >
            Active
        </option>

        <option
            value="inactive"
            <?= ($item['status'] ?? '') === 'inactive'
                ? 'selected'
                : '' ?>
        >
            Inactive
        </option>

        <option
            value="discontinued"
            <?= ($item['status'] ?? '') === 'discontinued'
                ? 'selected'
                : '' ?>
        >
            Discontinued
        </option>

    </select>

</p>

<button type="submit">

    Save Changes

</button>

</form>

</body>

</html>
