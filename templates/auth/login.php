<!DOCTYPE html>
<html>

<head>

    <title>
        Login
    </title>

</head>

<body>

    <h1>
        Film Studio Procurement System
    </h1>

    <?php if (!empty($error)): ?>

        <p style="color:red;">

            <?= htmlspecialchars(
                $error
            ) ?>

        </p>

    <?php endif; ?>

    <form method="post">

        <div>

            <label>

                Username or Email

            </label>

            <br>

            <input
                type="text"
                name="login"
                required
            >

        </div>

        <br>

        <div>

            <label>

                Password

            </label>

            <br>

            <input
                type="password"
                name="password"
                required
            >

        </div>

        <br>

        <button type="submit">

            Login

        </button>

    </form>

</body>

</html>