<?php
include "config.php";

$action = $_GET['action'] ?? '';

if ($action == 'read') {
    $result = $conn->query("SELECT * FROM students");
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    echo json_encode($students);
}

if ($action == 'create') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conn->prepare("INSERT INTO students (id, name, course, year, temperature, heartRate, oxygen, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiiis", $data['id'], $data['name'], $data['course'], $data['year'], $data['temperature'], $data['heartRate'], $data['oxygen'], $data['status']);
    $stmt->execute();
    echo "created";
}

if ($action == 'update') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conn->prepare("UPDATE students SET name=?, course=?, year=?, temperature=?, heartRate=?, oxygen=?, status=? WHERE id=?");
    $stmt->bind_param("sssiiiss", $data['name'], $data['course'], $data['year'], $data['temperature'], $data['heartRate'], $data['oxygen'], $data['status'], $data['id']);
    $stmt->execute();
    echo "updated";
}

if ($action == 'delete') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt->bind_param("s", $data['id']);
    $stmt->execute();
    echo "deleted";
}
?>
