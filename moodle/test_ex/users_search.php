<?php
$servername = 'localhost';
$username = 'petr';
$password = '123456';
$dbname = 'moodle';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Query to retrieve all courses
$sql = "SELECT *
FROM mdl_user u
JOIN mdl_role_assignments ra ON ra.userid = u.id
JOIN mdl_role r ON r.id = ra.roleid
WHERE r.shortname = 'student';";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo 'User firstname is: ' . $row['firstname'] . '; ' . 'User lastname is: ' . $row['lastname'] . "\n";
    }
} else {
    echo 'No users where found.';
}