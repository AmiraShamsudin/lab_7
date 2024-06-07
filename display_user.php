<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel=stylesheet href="style.css">
</head>
<body>

<h2>User Information</h2>

<table>
    <tr>
        <th>Matric</th>
        <th>Name</th>
        <th>Level</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["matric"]. "</td><td>" . $row["name"]. "</td><td>" . $row["role"]. "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No results found</td></tr>";
    }
    $conn->close();
    ?>
</table>

</body>
</html>
