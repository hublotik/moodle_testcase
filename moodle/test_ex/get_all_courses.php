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
$sql = 'SELECT id, fullname FROM mdl_course';

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo 'Course ID: ' . $row['id'] . ', Course Name: ' . $row['fullname'] . '<br>';
    }
} else {
    echo 'No courses found.';
}