<!DOCTYPE html>

<html>

<head>
    <title>Create Procurement Request</title>
</head>

<body>

<h1>Create Procurement Request</h1>

<p>

<a href="?page=procurement_requests">

Back to Requests

</a>

</p>

<?php if (!empty($error)): ?>

<p style="color:red;">

<?= htmlspecialchars($error) ?>

</p>

<?php endif; ?>

<form method="post">

<p>

    Title<br>

    <input
        type="text"
        name="title"
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

    Justification<br>

    <textarea
        name="justification"
        rows="4"
        cols="50"
    ></textarea>

</p>

<p>

    Priority<br>

    <select name="priority">

        <option value="low">
            Low
        </option>

        <option value="medium" selected>
            Medium
        </option>

        <option value="high">
            High
        </option>

        <option value="urgent">
            Urgent
        </option>

    </select>

</p>

<p>

    Required Date<br>

    <input
        type="date"
        name="required_date"
    >

</p>

<button type="submit">

    Create Request

</button>

</form>

</body>

</html>
