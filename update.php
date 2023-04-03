<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: info.php");
    exit();
}
include 'info.php';
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the updated user information from the form
    $email = $_SESSION['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];

    // Validate the user input
    if (empty($first_name) || empty($last_name) || empty($password)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address.";
    }elseif (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
      echo "Password must be at least 8 characters long and contain at least one letter and one number.";
    } 
     else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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

        // Update the user information in the database
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', password='$hashed_password' WHERE email='$email'";

        if ($conn->query($sql) === TRUE) {
            // Update the user's session data
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;

            // Redirect the user to their profile page
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error updating user information: " . $conn->error;
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px #ccc;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        p.error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Update User Information</h1>

    <?php
    // Display any error messages
    if (isset($error_message)) {
        echo "<p class=\"error\">$error_message</p>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $_SESSION['first_name']; ?>">

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $_SESSION['last_name']; ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Update">
    </form>
</body>
</html>






