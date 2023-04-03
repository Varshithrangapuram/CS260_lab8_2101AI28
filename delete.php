<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user's email from the session data
    $email = $_SESSION['email'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "Varshith@1511";
    $dbname = "dblab8";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user confirmed the account deletion
    if ($_POST['confirm'] == 'yes') {
        // Delete the user's account from the database
        $sql = "DELETE FROM users WHERE email='$email'";

        if ($conn->query($sql) === TRUE) {
            // Remove the session data and redirect the user to the login page
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Error deleting user account: " . $conn->error;
        }
    } else {
        // Redirect the user to their profile page if they didn't confirm the account deletion
        header("Location: profile.php");
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        .confirmation-message {
            margin: 20px auto;
            width: 50%;
            text-align: center;
        }
        .confirmation-message p {
            margin-bottom: 10px;
        }
        .confirmation-message input[type="submit"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Delete Account</h1>

    <?php
    // Display a confirmation message asking the user to confirm the account deletion
    if (!isset($_POST['confirm'])) {
        echo "<div class='confirmation-message'>";
        echo "<p>Are you sure you want to delete your account?</p>";
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
        echo "<input type='submit' name='confirm' value='yes'> Yes ";
        echo "<input type='submit' name='confirm' value='no'> No ";
        echo "</form>";
        echo "</div>";
    } else {
        // Display any error messages
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        }
    }
    ?>
</body>
</html>
