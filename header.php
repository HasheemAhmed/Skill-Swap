<?php
$isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in

// Check if the user is logged in
if ($isLoggedIn) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "skill_swap";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $userId = $_SESSION['user_id'];
    $query = "SELECT profile_picture FROM profile WHERE user_id = '$userId'"; // Adjust table/column names as per your database
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Get the profile picture filename or path
    $profilePicture = $user['profile_picture']; // Assuming this column contains the filename
}
?>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="home.php">
            <img src="images/skill swap icon.png" alt="Logo">Skill Swap
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logins.php">Login</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="sevices.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item"><a  href="add_service.php">Add Services</a></li>
                        <li class="dropdown-item"><a  href="sevices.php">Show Services</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">About Us</a>
                </li>

            </ul>
            <?php if ($isLoggedIn): ?>
                <a href="profile.php" class="profile-manager d-flex align-items-center">
                    <?php if (!empty($profilePicture)): ?>
                        <!-- If profile picture is available, display it with a white round border -->
                        <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Pic" class="rounded-circle" style="width: 35px; height: 35px; border: 3px solid white;">
                    <?php else: ?>
                        <!-- If profile picture is not available, show Font Awesome icon with the same border and style -->
                        <i class="fas fa-user-circle" style="font-size: 35px; color: #fff; border: 3px solid white; border-radius: 50%;"></i>
                    <?php endif; ?>
                    <span>Profile Manager</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>