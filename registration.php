<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role'])) {
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = $_POST['role'];

        
        $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: All fields are required";
    }
}


$conn->close();
?>
