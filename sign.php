<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css files/signupstyle.css">
    <?php include('links.php'); ?>
</head>

<body>
<?php include('header.php'); ?>
    <div class="back">
        <div class="containers">
            <div class="left">
                <div class="logo">
                    <img alt="Skill Swap Logo" height="50" src="images/skill swap logo.png" width="50" />
                    <h1> <span class="light-blue">Skill</span> Swap
                    </h1>
                </div>
                <div class="tagline">
                    Unlock Your Potential: Exchange Skills, Share Knowledge, Build Connections!
                </div>
                <div>
                    <div class="signup-now">
                        Sign Up Now
                    </div>
                    <div class="fs-6 lk">
                        Already have an account? <a href="logins.php">Log in</a>
                    </div>
                </div>
            </div>
            <div class="right">
                <h2>
                    Create Account
                </h2>
                <form id = "signup-form" method="POST">
                    <div class="form-group">
                        <label for="name">
                            Name
                        </label>
                        <input id="name" name="name" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="username">
                            Username
                        </label>
                        <input id="username" name="username" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="email">
                            Email
                        </label>
                        <input id="email" name="email" type="email" />
                    </div>
                    <div class="line form-group ">
                        <div class="c1">
                            <label for="password">
                                Password
                            </label>
                            <input id="password" name="password" type="password" />
                        </div>
                        <div class="c1">
                            <label for="confirm-password">
                                Confirm Password
                            </label>
                            <input id="confirm-password" name="confirm-password" type="password" />
                        </div>
                    </div>
                    <div id="response-message"></div>
                    <div class="signup-button">
                        <button type="submit" onclick="submitForm(event)">
                            Sign up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>