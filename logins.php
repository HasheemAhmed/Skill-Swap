<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <?php include('links.php'); ?>
    <link rel="stylesheet" href="css files/loginstyle.css">
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
                        Log In Now
                    </div>
                    <div class="fs-6 lk">
                        Don't have an account? <a href="sign.php">Sign Up</a>
                    </div>
                </div>
            </div>
            <div class="right">
                <h2>
                    Log In
                </h2>
                <form id="signup-form" method="POST">

                    <div class="form-group">
                        <label for="email">
                            Email
                        </label>
                        <input id="email" name="email" type="email" />
                    </div>
                    <div class="form-group ">
                        <label for="password">
                            Password
                        </label>
                        <input id="password" name="password" type="password" />
                    </div>
                    <div id="response-message"></div>
                    <div class="signup-button">
                        <button type="submit" onclick="submitFormLogin(event)">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>