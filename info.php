<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>User Details</title>
      <style>
         body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
            }
            h2 {
                text-align: center;
            }
            .details {
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
   <div class="details">
      <h2>User Details</h2>
      <p><?php echo "First Name: " . $_SESSION['first_name']; ?></p>
      <p><?php echo "Last Name: " . $_SESSION['last_name']; ?></p>
      <p><?php echo "Email: " . $_SESSION['email']; ?></p>
   </div>
</body>
</html>