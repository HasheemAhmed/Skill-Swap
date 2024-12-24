<?php

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
    $name = sanitizeInput($_POST['name']);
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirm-password']);

    if (empty($name) || empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        http_response_code(400); 
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); 
        echo json_encode(["error" => "Invalid email format."]);
        exit();
    }

    if ($password !== $confirmPassword) {
        http_response_code(400); 
        echo json_encode(["error" => "Passwords do not match."]);
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT * FROM signupinfo WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        http_response_code(409); // Conflict
        echo json_encode(["error" => "Username or email already exists."]);
        exit();
    }

    // Insert user into signupinfo table
    $stmt = $conn->prepare("INSERT INTO signupinfo (name, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Get the last inserted user ID
        $userId = $conn->insert_id;

        // Insert empty data into the profile table
        $profileStmt = $conn->prepare("INSERT INTO profile (user_id, full_name, email, phone, location, skills, experience, profile_picture, bio) VALUES (?, '', '', '', '', '', '', '', '')");
        $profileStmt->bind_param("i", $userId);

        if ($profileStmt->execute()) {
            http_response_code(200); // OK
            echo json_encode(["message" => "Signup successful! Profile created. You can now log in."]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => "User created, but failed to initialize profile."]);
        }

        $profileStmt->close();
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Error inserting user into the database."]);
    }

    $stmt->close();
}

$conn->close();
?>
