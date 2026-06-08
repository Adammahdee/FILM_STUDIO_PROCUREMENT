<!DOCTYPE html>

<html>

<head>
    <title>Create Supplier</title>
</head>

<body>

<h1>Create Supplier</h1>

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
        required
    >
</p>

<p>
    Contact Person<br>
    <input
        type="text"
        name="contact_person"
    >
</p>

<p>
    Email<br>
    <input
        type="email"
        name="email"
    >
</p>

<p>
    Phone<br>
    <input
        type="text"
        name="phone"
    >
</p>

<p>
    Address<br>
    <textarea
        name="address"
        rows="4"
        cols="40"
    ></textarea>
</p>

<p>
    Website<br>
    <input
        type="text"
        name="website"
    >
</p>

<p>
    Tax ID<br>
    <input
        type="text"
        name="tax_id"
    >
</p>

<p>
    Payment Terms<br>
    <input
        type="text"
        name="payment_terms"
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
        value="0"
    >
</p>

<button type="submit">

    Create Supplier

</button>

</form>

</body>

</html>
