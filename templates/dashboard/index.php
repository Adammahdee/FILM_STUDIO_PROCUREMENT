<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

<h1>Dashboard</h1>

<p>

Welcome

<?= htmlspecialchars(
    $_SESSION['full_name'] ?? ''
) ?>

</p>

<p>

Role:

<?= htmlspecialchars(
    $_SESSION['role'] ?? ''
) ?>

</p>

<p>

<a href="?page=logout">

Logout

</a>

</p>

</body>

</html>