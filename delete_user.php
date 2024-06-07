<?php
session_start();

if (!isset($_SESSION['matric'])) {
    header(Location: login_page.php);
    exit();
}

$servername ="localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

$conn = new mysqli ($servername, $username, $password, $dbname)

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $matric = $_GET['matric'];


    $database = new Database();
    $db = $database->getConnection();

    
    $user = new User($db);

    
    $deleted = $user->deleteUser($matric);

    if ($deleted) {
        echo "User with matric number $matric has been deleted successfully.";
    } else {
        echo "Failed to delete user with matric number $matric.";
    }

    n
    $db->close();
}
?>
