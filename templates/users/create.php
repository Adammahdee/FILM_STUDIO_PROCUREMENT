<!DOCTYPE html>

<html>

<head>
    <title>Create User</title>
</head>

<body>

<h1>Create User</h1>

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
        name="username"
        required
    >
</p>

<p>
    Email<br>
    <input
        type="email"
        name="email"
        required
    >
</p>

<p>
    Full Name<br>
    <input
        type="text"
        name="full_name"
        required
    >
</p>

<p>
    Password<br>
    <input
        type="password"
        name="password"
        required
    >
</p>

<p>
    Role<br>

    <select name="role" required>

        <option value="admin">
            admin
        </option>

        <option value="manager">
            manager
        </option>

        <option value="procurement_officer">
            procurement_officer
        </option>

        <option value="department_head">
            department_head
        </option>

    </select>

</p>

<p>
    Department<br>
    <input
        type="text"
        name="department"
    >
</p>

<p>
    Phone<br>
    <input
        type="text"
        name="phone"
    >
</p>

<button type="submit">
    Create User
</button>

</form>

</body>

</html>
