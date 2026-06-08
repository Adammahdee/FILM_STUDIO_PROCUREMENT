<!DOCTYPE html>

<html>

<head>
    <title>Edit Supplier</title>
</head>

<body>

<h1>Edit Supplier</h1>

<p>

<a href="?page=suppliers">

Back to Suppliers

</a>

</p>

<?php if (!empty($error)): ?>

<p style="color:red;">

<?= htmlspecialchars($error) ?>

</p>

<?php endif; ?>

<form method="post">

<p>
    Company Name<br>
    <input
        type="text"
        name="company_name"
        value="<?= htmlspecialchars($supplier['company_name'] ?? '') ?>"
        required
    >
</p>

<p>
    Contact Person<br>
    <input
        type="text"
        name="contact_person"
        value="<?= htmlspecialchars($supplier['contact_person'] ?? '') ?>"
    >
</p>

<p>
    Email<br>
    <input
        type="email"
        name="email"
        value="<?= htmlspecialchars($supplier['email'] ?? '') ?>"
    >
</p>

<p>
    Phone<br>
    <input
        type="text"
        name="phone"
        value="<?= htmlspecialchars($supplier['phone'] ?? '') ?>"
    >
</p>

<p>
    Address<br>
    <textarea
        name="address"
        rows="4"
        cols="40"
    ><?= htmlspecialchars($supplier['address'] ?? '') ?></textarea>
</p>

<p>
    Website<br>
    <input
        type="text"
        name="website"
        value="<?= htmlspecialchars($supplier['website'] ?? '') ?>"
    >
</p>

<p>
    Tax ID<br>
    <input
        type="text"
        name="tax_id"
        value="<?= htmlspecialchars($supplier['tax_id'] ?? '') ?>"
    >
</p>

<p>
    Payment Terms<br>
    <input
        type="text"
        name="payment_terms"
        value="<?= htmlspecialchars($supplier['payment_terms'] ?? '') ?>"
    >
</p>

<p>
    Rating<br>
    <input
        type="number"
        step="0.1"
        min="0"
        max="5"
        name="rating"
        value="<?= htmlspecialchars((string)($supplier['rating'] ?? 0)) ?>"
    >
</p>

<button type="submit">

    Save Changes

</button>

</form>

</body>

</html>
