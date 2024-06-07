<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['matric'] = $matric;
            header("Location: display_users.php");
            exit();
        } else {
            echo "Invalid username or password, try <a href='login_page.php'>login</a> again.";
        }
    } else {
        echo "Invalid username or password, try <a href='login_page.php'>login</a> again.";
    }
}

$conn->close();
?>
