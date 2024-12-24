<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="css files/aboutus.css">
    <?php include('links.php'); ?>
</head>

<body>
<?php include('header.php'); ?>
    <!-- About Us Section -->
    <div class="container my-5">
    <div class="about-us-section bg-blue text-white p-4 rounded shadow">
        <h2 class="text-center fw-bold">About Skill Swap</h2>
        <p class="text-center mt-3 fs-5">
            Skill Swap is a platform designed to help individuals exchange their skills with others. Whether you're offering a service or looking for someone to fulfill a need, Skill Swap connects like-minded individuals to help each other grow and succeed. Our mission is to create a community where people can easily share their skills and talents.
        </p>
    </div>
</div>


<div class="container my-5">
    <h2 class="text-center fw-bold mb-5 line">Meet Our Team</h2>
    <div class="row text-center">
        <!-- Team Member 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow">
                <img src="images/ansar.png" class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 1" style="width: 120px; height: 120px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Ansar Mehmood</h5>
                    <p class="card-text text-muted">Co-Founder & Developer</p>
                </div>
            </div>
        </div>
        <!-- Team Member 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow">
                <img src="images/hasheem.png" class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 2" style="width: 120px; height: 120px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Hasheem Ahmad</h5>
                    <p class="card-text text-muted">Co-Founder & Designer</p>
                </div>
            </div>
        </div>
        <!-- Team Member 3 -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow">
                <img src="images/usman.png" class="card-img-top rounded-circle mx-auto mt-3" alt="Team Member 3" style="width: 120px; height: 120px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Usman Mukhtar</h5>
                    <p class="card-text text-muted">Lead Developer</p>
                </div>
            </div>
        </div>
    </div>
</div>

 
    <?php include('footer.php'); ?></body>

</html>
