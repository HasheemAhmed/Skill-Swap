
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include('links.php'); ?>
    <link rel="stylesheet" href="css files/profile.css">
</head>
<body>

<?php include('header.php'); ?>
    <!-- Profile Manager Section -->
    <div class="container profile-section">
        <div class="profile-container">
            <img src="<?php if (!empty($profile['profile_picture'])): ?>
                            <?php echo htmlspecialchars($profile['profile_picture']); ?>
                        <?php endif; ?>" alt="Profile Picture">
            <h2>Manage Your Profile</h2>
            <p>Update your profile details below</p>

            <!-- Profile Form -->
            <div class="profile-card">
                <form id="profileForm" action="profiles.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" value="<?php echo htmlspecialchars($profile['full_name'] ?? ''); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($profile['email'] ?? ''); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" value="<?php echo htmlspecialchars($profile['location'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <textarea class="form-control" id="skills" rows="3" name="skills" required><?php echo htmlspecialchars($profile['skills'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="experience">Experience</label>
                        <textarea class="form-control" id="experience" name="experience" rows="4"><?php echo htmlspecialchars($profile['experience'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profilePicture">Profile Picture</label>
                        <input type="file" class="form-control" name="profilePicture" id="profilePicture">
                        
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" id="bio" rows="4" name="bio" required><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
                    </div>
                
                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                </form>
                
            </div>
        </div>
    </div>

    
    <?php include('footer.php'); ?><script>
        // Simple form validation and progress tracking
        document.getElementById("profileForm").addEventListener("input", function() {
            let totalFields = 7; // Total number of required fields
            let completedFields = 0;

            // Check if each required field has a value
            document.querySelectorAll("input, textarea").forEach((field) => {
                if (field.value.trim()) {
                    completedFields++;
                }
            });

            let progress = (completedFields / totalFields) * 100;
            document.querySelector(".progress-bar").style.width = progress + "%";
            document.querySelector(".progress-bar").setAttribute("aria-valuenow", progress);
        });
    </script>

</body>
</html>
