<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="style.css">
    <title>Login Page</title>
</head>

<body>
    <form action="login.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

    <input type="submit" name="submit" value="Register">
</form>

<p><a href="registration_page.php">Register</a> here if you have not. </p>

</body>
</html>