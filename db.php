<?php
$host = "localhost";
$user = "root"; // default username sa XAMPP
$pass = ""; // walang password by default
$dbname = "campushealth"; // pangalan ng database mo

// Gumamit ng 'mysqli' (hindi 'mysql')
$conn = new mysqli($host, $user, $pass, $dbname);

// I-check kung may error sa connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Optional: para lang malaman mong gumagana
// echo "Connected successfully!";
?>
