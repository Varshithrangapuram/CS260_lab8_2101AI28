<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Profile Page</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
            }
            h1 {
                text-align: center;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }
            .welcome-message {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }
            .name {
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }
            a {
                display: block;
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Profile Page</h1>
            <div class="welcome-message">
                Welcome
            </div>
            <div class="name">
                <?php echo ($_SESSION['first_name'] . " " . $_SESSION['last_name']); ?>
            </div>
            <a href="http://localhost:8012/mac/db.php">Click here to check details</a>
            <br>
		    <br>
		    <a href="http://localhost:8012/mac/delete.php">Click here to delete the account</a>
            <a href="http://localhost:8012/mac/update.php">Click here to update the account</a>
        </div>
    </body>
</html>
