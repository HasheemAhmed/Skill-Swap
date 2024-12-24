<?php
session_start();  // Ensure session is started

// Database connection
$conn = new mysqli("localhost", "root", "", "skill_swap");

// Check connection
if ($conn->connect_error) {
    http_response_code(500); 
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'] ?? null;  // Get user ID from session

    // Ensure user is logged in
    if (!$user_id) {
        http_response_code(401); // Unauthorized
        echo json_encode(["error" => "You must be logged in to add a service."]);
        exit();
    }

    // Collect form data
    $service_title = $_POST['service_title'] ?? null;
    $service_description = $_POST['service_description'] ?? null;
    $skills_offered = $_POST['skills_offered'] ?? null;
    $skills_needed = $_POST['skills_needed'] ?? null;

    // Validate input
    if (!$service_title || !$service_description || !$skills_offered || !$skills_needed) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "All fields are required."]);
        exit();
    }

    // Handle file uploads
    $uploaded_images = [];
    if (!empty($_FILES['service_images']['name'][0])) {
        foreach ($_FILES['service_images']['name'] as $key => $file_name) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($file_name);
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate file type
            $allowed_types = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($file_type, $allowed_types)) {
                http_response_code(400); // Bad Request
                echo json_encode(["error" => "Only JPG, JPEG, PNG, and GIF files are allowed."]);
                exit();
            }

            // Move uploaded file
            if (move_uploaded_file($_FILES['service_images']['tmp_name'][$key], $target_file)) {
                $uploaded_images[] = $target_file;
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["error" => "Failed to upload one or more files."]);
                exit();
            }
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Please upload at least one image."]);
        exit();
    }

    // Save service to database
    $images_serialized = implode(",", $uploaded_images); // Save file paths as a comma-separated string
    $stmt = $conn->prepare("INSERT INTO services (user_id, service_title, service_description, skills_offered, skills_needed, service_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $service_title, $service_description, $skills_offered, $skills_needed, $images_serialized);

    if ($stmt->execute()) {
        http_response_code(200); // OK
        echo json_encode(["message" => "Service added successfully."]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Failed to add service: " . $conn->error]);
    }

    $stmt->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid request method."]);
}

$conn->close();
?>
