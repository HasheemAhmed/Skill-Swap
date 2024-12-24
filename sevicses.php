<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Services - Skill Swap</title>
    <?php include('links.php'); ?>
    <link rel="stylesheet" href="css files/showservices.css">
</head>

<body>
    <?php include('header.php'); ?>

    <!-- Show Services Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Example of a Service Card -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="service-card">
                    <div class="service-slider">
                        <img src="image1.webp" alt="Service Image">
                        <img src="image2.webp" alt="Service Image">
                        <img src="image3.webp" alt="Service Image">
                        <div class="slider-buttons">
                            <button class="prev" onclick="changeSlide(this, -1)">Prev</button>
                            <button class="next" onclick="changeSlide(this, 1)">Next</button>
                        </div>
                    </div>
                    <h3 class="service-title">Web Development</h3>
                    <p class="service-description">Professional web development services using modern technologies to build responsive websites. Professional web development services using modern technologies to build responsive websites.Professional web development services using modern technologies to build responsive websites.Professional web development services using modern technologies to build responsive websites.</p>
                    <span class="see-more" onclick="toggleDescription(this)">See More</span>
                    <div class="service-info">
                        <div><strong>Skills Offered:</strong> HTML, CSS, JavaScript</div>
                        <div><strong>Skills Needed:</strong> Graphic Design</div>
                    </div>
                    <div class="service-buttons">
                        <a href="profile.html" class="btn btn-primary">View Profile</a>
                        <a href="message.html" class="btn btn-secondary">Send Message</a>
                    </div>
                </div>
            </div>
            <!-- Repeat structure for more services -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="service-card">
                    <div class="service-slider">
                        <img class=active src="image1.webp" alt="Service Image">
                        <img src="image2.webp" alt="Service Image">
                        <img src="image3.webp" alt="Service Image">
                        <div class="slider-buttons">
                            <button class="prev" onclick="changeSlide(this, -1)">Prev</button>
                            <button class="next" onclick="changeSlide(this, 1)">Next</button>
                        </div>
                    </div>
                    <h3 class="service-title">Web Development</h3>
                    <p class="service-description">Professional web development services using modern technologies to build responsive websites. Professional web development services using modern technologies to build responsive websites.Professional web development services using modern technologies to build responsive websites.Professional web development services using modern technologies to build responsive websites.</p>
                    <span class="see-more" onclick="toggleDescription(this)">See More</span>
                    <div class="service-info">
                        <div><strong>Skills Offered:</strong> HTML, CSS, JavaScript</div>
                        <div><strong>Skills Needed:</strong> Graphic Design</div>
                    </div>
                    <div class="service-buttons">
                        <a href="profile.html" class="btn btn-primary">View Profile</a>
                        <a href="message.html" class="btn btn-secondary">Send Message</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>
