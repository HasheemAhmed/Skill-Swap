<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skill_swap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500); 
    echo json_encode(["error" => "Database connection failed."]);
    exit();
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    if (empty($email) || empty($password)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Email and password are required."]);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid email format."]);
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM signupinfo WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(401); // Unauthorized
        echo json_encode(["error" => "No account found with this email."]);
        exit();
    }

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        http_response_code(200); // OK
        echo json_encode(["message" => "Login successful!", "user" => $user['name']]);
    } else {
        http_response_code(401); // Unauthorized
        echo json_encode(["error" => "Incorrect password."]);
    }

    $stmt->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Only POST method is allowed."]);
}

$conn->close();
?>
