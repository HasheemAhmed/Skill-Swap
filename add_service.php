<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Services</title>
    <?php include('links.php') ?>
    <link rel="stylesheet" href="css files/addservice.css">
</head>

<body>

<?php include('header.php'); ?>
    <!-- Add Services Form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-10 mb-4">
                <div class="card shadow-lg">
                    <div class="card-header text-center  text-white">
                        <h2>Add Your Services</h2>
                        <p>Enter the details of the services you want to offer and what skills you're looking for in exchange.</p>
                    </div>
                    <div class="card-body">
                        <form id="add-service" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="service-title" class="form-label">Service Title</label>
                                <input type="text" id="service-title" name="service_title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="service-description" class="form-label">Description</label>
                                <textarea id="service-description" name="service_description" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="skills-offered" class="form-label">Skills Offered</label>
                                <input type="text" id="skills-offered" name="skills_offered" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="skills-needed" class="form-label">Skills Needed</label>
                                <input type="text" id="skills-needed" name="skills_needed" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="service-image" class="form-label">Upload Images</label>
                                <input type="file" id="service-image" name="service_images[]" class="form-control" multiple required>
                            </div>

                            <div id="response-message"></div>

                            <button type="button" onclick="submitServiceForm(event)" class="btn w-100 text-white fw-bold">Add Service</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>