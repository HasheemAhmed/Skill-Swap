<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skill_swap";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Services from Database
$sql = "SELECT * FROM services";
$result = $conn->query($sql);


if (!$result) {
    die("Query failed: " . $conn->error); // Debug query failure
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <?php include('links.php'); ?>
    <link rel="stylesheet" href="css files/showservices.css">

</head>

<body>
    <?php include('header.php'); ?>
    <div class="containers container">
        <h1>Available Services</h1>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="service-card col-3">';

                    // Image Slider
                    if (isset($row['service_image']) && !empty($row['service_image'])) {
                        $images = explode(',', $row['service_image']);
                        $carouselId = "carousel-" . uniqid();
                        echo '<div id="' . $carouselId . '" class="carousel slide mb-3" data-bs-ride="carousel">';

                        // Indicators
                        echo '<div class="carousel-indicators">';
                        foreach ($images as $index => $image) {
                            echo '<button type="button" data-bs-target="#' . $carouselId . '" data-bs-slide-to="' . $index . '" ' . ($index === 0 ? 'class="active"' : '') . '></button>';
                        }
                        echo '</div>';

                        // Images
                        echo '<div class="carousel-inner">';
                        foreach ($images as $index => $image) {
                            echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
                            echo '<img src="' . htmlspecialchars($image) . '" class="d-block w-100 rounded" alt="Service Image">';
                            echo '</div>';
                        }
                        echo '</div>';

                        // Controls
                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="prev">';
                        echo '<span class="carousel-control-prev-icon icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Previous</span>';
                        echo '</button>';
                        echo '<button class="carousel-control-next" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="next">';
                        echo '<span class="carousel-control-next-icon  icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Next</span>';
                        echo '</button>';

                        echo '</div>';
                    }

                    // Fetch User Info
                    $user = $row['user_id'];
                    $profile = "SELECT full_name , profile_picture FROM profile WHERE user_id = '$user'";
                    $userinfo = $conn->query($profile);
                    $userinfo = $userinfo->fetch_assoc();

                    // Profile Section
                    echo '<div class="profile-section d-flex align-items-center mb-3">';

                    // Check if profile picture exists, else use Font Awesome icon
                    if (isset($userinfo['profile_picture']) && !empty($userinfo['profile_picture'])) {
                        echo '<img src="' . htmlspecialchars($userinfo['profile_picture']) . '" alt="Profile Picture" class="profile-pic me-3">';
                    } else {
                        echo '<i class="fa fa-user-circle profile-pic me-3" style="font-size: 50px; color: #003169;"></i>';
                    }

                    echo '<h4 class="username">' . htmlspecialchars($userinfo['full_name']) . '</h4>';
                    echo '</div>';

                    // Service Description with View More functionality
                    $description = $row['service_description'];
                    echo '<p class="service-description" style = "height:70px;">' . htmlspecialchars(substr($description, 0, 100)) . '...</p>';


                    // Skills Offered and Needed
                    echo '<p><strong>Skills Offered:</strong> ' . htmlspecialchars($row['skills_offered']) . '</p>';
                    echo '<p><strong>Skills Needed:</strong> ' . htmlspecialchars($row['skills_needed']) . '</p>';

                    // Buttons
                    echo '<div class="button-group mt-3 d-flex justify-content-between">';
                    echo '<button class="btn btn-primary btn-sm me-2 w-100 buton">Message</button>';
                    echo '<a href="view_service.php?id=' . $row['id'] . '" class="btn btn-outline-primary btn-sm w-100">View Service</a>';
                    echo '</div>';

                    echo '</div>'; // End of Service Card
                }
            } else {
                echo '<p>No services available at the moment.</p>';
            }
            ?>

        </div>
    </div>



    <?php include('footer.php'); ?>
</body>

</html>