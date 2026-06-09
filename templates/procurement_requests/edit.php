<!DOCTYPE html>

<html>

<head>
    <title>Edit Procurement Request</title>
</head>

<body>

<h1>Edit Procurement Request</h1>

<p>

<a href="?page=procurement_requests">

Back to Requests

</a>

|

<a href="?page=procurement_request_view&id=<?= (int)($request['id'] ?? 0) ?>">

View Request

</a>

</p>

<?php if (!empty($error)): ?>

<p style="color:red;">

<?= htmlspecialchars($error) ?>

</p>

<?php endif; ?>

<form method="post">

<p>

Request Number<br>

<input
type="text"
value="<?= htmlspecialchars($request['request_number'] ?? '') ?>"
readonly

>

</p>

<p>

Title<br>

<input
type="text"
name="title"
value="<?= htmlspecialchars($request['title'] ?? '') ?>"
required

>

</p>

<p>

Description<br>

<textarea
    name="description"
    rows="4"
    cols="50"
><?= htmlspecialchars($request['description'] ?? '') ?></textarea>

</p>

<p>

Justification<br>

<textarea
    name="justification"
    rows="4"
    cols="50"
><?= htmlspecialchars($request['justification'] ?? '') ?></textarea>

</p>

<p>

Priority<br>

<select name="priority">

<option value="low"
<?= ($request['priority'] ?? '') === 'low' ? 'selected' : '' ?>>
Low
</option>

<option value="medium"
<?= ($request['priority'] ?? '') === 'medium' ? 'selected' : '' ?>>
Medium
</option>

<option value="high"
<?= ($request['priority'] ?? '') === 'high' ? 'selected' : '' ?>>
High
</option>

<option value="urgent"
<?= ($request['priority'] ?? '') === 'urgent' ? 'selected' : '' ?>>
Urgent
</option>

</select>

</p>

<p>

Required Date<br>

<input
type="date"
name="required_date"
value="<?= htmlspecialchars($request['required_date'] ?? '') ?>"

>

</p>

<p>

Status<br>

<input
type="text"
value="<?= htmlspecialchars($request['status'] ?? '') ?>"
readonly

>

</p>

<button type="submit">

Save Changes

</button>

</form>

</body>

</html>
