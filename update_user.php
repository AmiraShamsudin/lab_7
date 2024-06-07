<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['matric'])) {
    header("Location: login_page.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["matric"])) {
    $matric = $_GET["matric"];
    $sql = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $role = $row["role"];
    } else {
        echo "User not found.";
        exit();
    }
    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $name = $_POST["name"];
    $role = $_POST["role"];

    $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $role, $matric);

    if ($stmt->execute() === TRUE) {
        header("Location: display_users.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Update User</h2>
    <form action="update_user.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($matric); ?>" readonly><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="">Select</option>
            <option value="student" <?php if ($role == 'student') echo 'selected'; ?>>Student</option>
            <option value="lecturer" <?php if ($role == 'lecturer') echo 'selected'; ?>>Lecturer</option>
        </select><br><br>
        <input type="submit" value="Update">
        <a href="display_users.php">Cancel</a>
    </form>
</body>
</html>
