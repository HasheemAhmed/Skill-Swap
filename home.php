<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Swap</title>
    <?php include('links.php'); ?>
    <link rel="stylesheet" href="css files/home.css">
    
</head>

<body>

    <?php include('header.php'); ?>
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Content -->
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-5 fw-bold">Swap skills with talented individuals<br>for any project, anytime.</h1>
                    <p class="lead mt-3">Millions of people use SkillSwap to collaborate and bring their ideas to life through shared expertise.</p>
                    <div class="mt-4">
                        <a href="sevices.php" class="btn  btn1 btn-lg me-3">See Services</a>
                        <a href="logins.php" class="btn btn2 btn-lg">Give Services</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="images/hero.png" alt="Illustration" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="contaier-fluid  p-4 slides">
            <h2 class="heading">Skills you can exchange</h2>
            <div class="slider">
                <div class="box"><img src="images/graphic.png" alt="">Graphic Designer</div>
                <div class="box"><img src="images/web.png" alt="">Web Developer</div>
                <div class="box"><img src="images/content.png" alt="">Content Writer</div>
                <div class="box"><img src="images/video.png" alt="">Video Editor</div>
                <div class="box"><img src="images/data.png" alt="">Data Entry</div>
                <div class="box"><img src="images/ai.png" alt="">AI/ML</div>
            </div>
        </div>
    </section>

    <section>
        <div class="contain">
            <h2 class="text-center mb-4">Need a Skill Swap?</h2>
            <p class="text-center text-muted mb-5">Discover skills, connect with others, and exchange expertise in a few simple steps.</p>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                <div class="col">
                    <div class="feature-section text-center">
                        <img src="images/post.png" alt="Post your skill icon">
                        <h5>Post Your Skill</h5>
                        <p>Share your expertise and let others know what you can offer in exchange for their skills.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="feature-section text-center">
                        <img src="images/find.png" alt="Find skills icon">
                        <h5>Find Skills</h5>
                        <p>Browse available skills and connect with the right people to meet your needs.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="feature-section text-center">
                        <img src="images/safe.png" alt="Make safe connections icon">
                        <h5>Safe Connections</h5>
                        <p>Connect with verified users and ensure a trustworthy, seamless skill swap experience.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="feature-section text-center">
                        <img src="images/help.png" alt="Support and guidance icon">
                        <h5>Support & Guidance</h5>
                        <p>We’re here to assist you at every step of your journey on the Skill Swap platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="skill-swap-section">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <img src="images/market.svg" alt="Skill Swap" class="img-fluid rounded shadow-sm">
                </div>


                <div class="col-md-6 p-5">
                    <h2>Join the World’s Best Professionals on Skill Swap</h2>
                    <p>Unlock new opportunities, expand your network, and enhance your skills through our global platform. Whether you want to teach, learn, or collaborate, connect with experts worldwide and exchange knowledge.</p>
                    <ul>
                        <li><strong>Access Talented Professionals:</strong> Connect with experts across various fields.</li>
                        <li><strong>Grow Your Skills:</strong> Learn directly from experienced professionals.</li>
                        <li><strong>Collaborate & Create:</strong> Work on projects to enhance your portfolio.</li>
                    </ul>
                    <a href="sevices.php" class="btn btn-primary">Explore Services</a>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us-section">
        <h2>About Skill Swap</h2>
        <p>Skill Swap is a platform designed to help individuals exchange their skills with others. Whether you're offering a service or looking for someone to fulfill a need, Skill Swap connects like-minded individuals to help each other grow and succeed. Our mission is to create a community where people can easily share their skills and talents.</p>
        <a href="#about" class="btn btn-primary">
            See About Us <i class="fas fa-arrow-right"></i>
        </a>
    </section>


    <?php include('footer.php'); ?>
</body>

</html>