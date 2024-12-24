<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skill_swap";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$userId = $_SESSION['user_id']; // Assuming user_id is set in the session

// Fetch existing profile data
$profile = null;
$stmt = $conn->prepare("SELECT full_name, email, phone, location, skills, experience, profile_picture, bio FROM profile WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
}
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'] ?? null;
    $skills = $_POST['skills'];
    $experience = $_POST['experience'] ?? null;
    $bio = $_POST['bio'];

    // Handle file upload for profile picture
    $profilePicture = $profile['profile_picture']; // Use existing picture by default
    if (!empty($_FILES['profilePicture']['name']) && $_FILES['profilePicture']['error'] == 0) {
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($_FILES['profilePicture']['name']);
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFile)) {
                $profilePicture = $uploadFile;
            } else {
                echo "Error uploading profile picture.";
            }
        } else {
            echo "Invalid file type for profile picture.";
        }
    }

    // Update existing profile
    $stmt = $conn->prepare("UPDATE profile SET full_name = ?, email = ?, phone = ?, location = ?, skills = ?, experience = ?, profile_picture = ?, bio = ? WHERE user_id = ?");
    $stmt->bind_param("ssssssssi", $fullName, $email, $phone, $location, $skills, $experience, $profilePicture, $bio, $userId);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
        header("Location: profile.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
