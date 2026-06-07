<!DOCTYPE html>

<html>

<head>
    <title>Edit User</title>
</head>

<body>

<h1>Edit User</h1>

<p>

<a href="?page=users">

Back to Users

</a>

</p>

<?php if (!empty($error)): ?>

<p style="color:red;">

<?= htmlspecialchars($error) ?>

</p>

<?php endif; ?>

<form method="post">

<p>

    Username<br>

    <input
        type="text"
        value="<?= htmlspecialchars($user['username'] ?? '') ?>"
        disabled
    >

</p>

<p>

    Full Name<br>

    <input
        type="text"
        name="full_name"
        value="<?= htmlspecialchars($user['full_name'] ?? '') ?>"
        required
    >

</p>

<p>

    Email<br>

    <input
        type="email"
        name="email"
        value="<?= htmlspecialchars($user['email'] ?? '') ?>"
        required
    >

</p>

<p>

    Role<br>

    <select name="role">

        <option value="admin"
            <?= ($user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>
            admin
        </option>

        <option value="manager"
            <?= ($user['role'] ?? '') === 'manager' ? 'selected' : '' ?>>
            manager
        </option>

        <option value="procurement_officer"
            <?= ($user['role'] ?? '') === 'procurement_officer' ? 'selected' : '' ?>>
            procurement_officer
        </option>

        <option value="department_head"
            <?= ($user['role'] ?? '') === 'department_head' ? 'selected' : '' ?>>
            department_head
        </option>

    </select>

</p>

<p>

    Department<br>

    <input
        type="text"
        name="department"
        value="<?= htmlspecialchars(
            $user['department'] ?? ''
        ) ?>"
    >

</p>

<p>

    Phone<br>

    <input
        type="text"
        name="phone"
        value="<?= htmlspecialchars(
            $user['phone'] ?? ''
        ) ?>"
    >

</p>

<button type="submit">

    Save Changes

</button>

</form>

</body>

</html>
