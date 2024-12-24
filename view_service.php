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

// Get Service ID from URL
$service_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch Service Details from Database
$sql = "SELECT * FROM services WHERE id = '$service_id'";
$result = $conn->query($sql);

// Check if service exists
if (!$result || $result->num_rows == 0) {
    die("Service not found");
}

$service = $result->fetch_assoc();

// Fetch User Info including experience, bio, and location
$user_id = $service['user_id'];
$profile_sql = "SELECT full_name, profile_picture, experience, bio, location FROM profile WHERE user_id = '$user_id'";
$user_info = $conn->query($profile_sql);
$user_info = $user_info->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details</title>
    <?php include('links.php'); ?>
    <link rel="stylesheet" href="css files/showservices.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .containers {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        h1 {
            font-size: 2.5rem;
            color: #003169;
            margin-bottom: 40px;
            text-align: center;
        }

        /* Heading Style */
        .heading {
            color: #003169;
            font-weight: bold;
            border-bottom: 3px solid #003169;
            width: 7.2em;
            margin-bottom: 20px;
            text-align: center;
            align-self: center;
        }

        /* Service Image Carousel */
        .carousel {
            position: relative;
            max-width: 100%;
            margin-bottom: 30px;
        }

        .carousel img {
            width: 90%;
            height: 40vw;
            object-fit: cover;
        }

       

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #fff;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            text-align: center;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .username {
            font-size: 1.5rem;
            font-weight: bold;
            color: #003169;
            margin-bottom: 10px;
        }

        .profile-info p {
            font-size: 1rem;
            color: #333;
            margin: 5px 0;
        }

        /* Service Details */
        .service-details {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 40px;
            text-align: center;
        }

        .service-details h4 {
            font-size: 2rem;
            color: #003169;
            margin-bottom: 20px;
        }

        .service-details p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 15px;
        }

        .service-details strong {
            color: #003169;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .button-group .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #003169;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #002a56;
        }

        .btn-outline-primary {
            border: 1px solid #003169;
            color: #003169;
            background-color: #fff;
        }

        .btn-outline-primary:hover {
            background-color: #003169;
            color: #fff;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .service-details {
                padding: 20px;
            }

            .carousel img {
                height: 50vw;
            }
        }

        @media (max-width: 576px) {
            .heading {
                font-size: 1.8rem;
                width: auto;
            }

            .carousel img {
                height: 40vw;
            }

            .service-details h4 {
                font-size: 1.6rem;
            }

            .service-details p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container containers mt-5">
        <h1 class="heading">Service Details</h1>
        <div class="service-details">
            <!-- Service Image Carousel -->
            <?php
            if (isset($service['service_image']) && !empty($service['service_image'])) {
                $images = explode(',', $service['service_image']);
                $carouselId = "carousel-" . uniqid();
                echo '<div id="' . $carouselId . '" class="carousel slide mb-4" data-bs-ride="carousel">';
                echo '<div class="carousel-inner">';
                foreach ($images as $index => $image) {
                    echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
                    echo '<img src="' . htmlspecialchars($image) . '" class="d-block w-100 rounded" alt="Service Image">';
                    echo '</div>';
                }
                echo '</div>';
                echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="prev">';
                echo '<span class="carousel-control-prev-icon icon" aria-hidden="true"></span>';
                echo '</button>';
                echo '<button class="carousel-control-next" type="button" data-bs-target="#' . $carouselId . '" data-bs-slide="next">';
                echo '<span class="carousel-control-next-icon icon" aria-hidden="true"></span>';
                echo '</button>';
                echo '</div>';
            }
            ?>

            <!-- Profile Section -->
            <div class="profile-section">
                <?php
                // Check if profile picture exists, else use Font Awesome icon
                if (isset($user_info['profile_picture']) && !empty($user_info['profile_picture'])) {
                    echo '<img src="' . htmlspecialchars($user_info['profile_picture']) . '" alt="Profile Picture" class="profile-pic">';
                } else {
                    echo '<i class="fa fa-user-circle profile-pic" style="font-size: 50px; color: #003169;"></i>';
                }
                ?>
                <div class="profile-info">
                    <h4 class="username"><?php echo htmlspecialchars($user_info['full_name']); ?></h4>
                    <p><strong>Experience:</strong> <?php echo htmlspecialchars($user_info['experience']); ?></p>
                    <p><strong>Bio:</strong> <?php echo nl2br(htmlspecialchars($user_info['bio'])); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($user_info['location']); ?></p>
                </div>
            </div>

            <!-- Full Service Details -->
            <h4><?php echo htmlspecialchars($service['service_title']); ?></h4>
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($service['service_description'])); ?></p>
            <p><strong>Skills Offered:</strong> <?php echo htmlspecialchars($service['skills_offered']); ?></p>
            <p><strong>Skills Needed:</strong> <?php echo htmlspecialchars($service['skills_needed']); ?></p>

            <!-- Contact Button -->
            <div class="button-group mt-3">
                <button class="btn btn-primary">Message</button>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>
