<?php
include 'db.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$action = $data["action"];

if ($action === "signup") {
    $username = $conn->real_escape_string($data["username"]);
    $email = $conn->real_escape_string($data["email"]);
    $password = password_hash($data["password"], PASSWORD_BCRYPT);

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($check->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Username already exists!"]);
        exit;
    }

    $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
    echo json_encode(["status" => "success", "message" => "Signup successful!"]);
}

if ($action === "login") {
    $username = $conn->real_escape_string($data["username"]);
    $password = $data["password"];

    $res = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($res->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
        exit;
    }

    $row = $res->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        echo json_encode(["status" => "success", "message" => "Login successful!", "user" => $row]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
    }
}
?>
