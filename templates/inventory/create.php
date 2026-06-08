<!DOCTYPE html>

<html>

<head>
    <title>Create Inventory Item</title>
</head>

<body>

<h1>Create Inventory Item</h1>

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
        required
    >
</p>

<p>
    Item Name<br>
    <input
        type="text"
        name="name"
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
    Category<br>
    <select name="category_id">

        <option value="">
            Select Category
        </option>

        <?php foreach ($categories ?? [] as $category): ?>

            <option value="<?= $category['id'] ?>">

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

            <option value="<?= $supplier['id'] ?>">

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
        value="pcs"
    >
</p>

<p>
    Unit Price<br>
    <input
        type="number"
        step="0.01"
        min="0"
        name="unit_price"
        value="0"
    >
</p>

<p>
    Quantity In Stock<br>
    <input
        type="number"
        min="0"
        name="quantity_in_stock"
        value="0"
    >
</p>

<p>
    Reorder Level<br>
    <input
        type="number"
        min="0"
        name="reorder_level"
        value="10"
    >
</p>

<p>
    Reorder Quantity<br>
    <input
        type="number"
        min="0"
        name="reorder_quantity"
        value="50"
    >
</p>

<p>
    Location<br>
    <input
        type="text"
        name="location"
    >
</p>

<p>
    Status<br>

    <select name="status">

        <option value="active">
            Active
        </option>

        <option value="inactive">
            Inactive
        </option>

        <option value="discontinued">
            Discontinued
        </option>

    </select>

</p>

<button type="submit">

    Create Item

</button>

</form>

</body>

</html>
