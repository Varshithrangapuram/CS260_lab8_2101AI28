
<?php
// Establish a MySQL connection
$conn = mysqli_connect("localhost", "root", "Varshith@1511", "dblab8");
if(!$conn){
    echo "Error: Unable to connect to MySQL database.";
    exit();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST['email'];
	$password = $_POST['password'];
	// Query the database for the user
	$query = "SELECT * FROM users WHERE email='$email'";
	$result = mysqli_query($conn, $query);

	// Check if the user exists and the password is correct
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row['password'])) {
			// Start the session and store the user's name
			session_start();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
			// Redirect the user to the welcome page
			header("Location: welcome.php");
			exit();
		} else {
			// Display an error message if the password is incorrect
			$error_message = "Invalid password.";
		}
	} else {
		// Display an error message if the user does not exist
		$error_message = "Invalid email or password.";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f0f0f0;
		}
		form {
			background-color: #fff;
			padding: 35px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			max-width: 400px;
			margin: 40px auto;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}
		input[type="email"],
		input[type="password"] {
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: 1px solid #ccc;
			width: 100%;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border-radius: 5px;
			border: none;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		p.error {
			color: #f00;
			margin-top: 10px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<h2>Login Form</h2>
	<form method="post" action="">
		<label>Email:</label>
		<input type="email" name="email" required><br><br>
		<label>Password:</label>
		<input type="password" name="password" required><br><br>
		<input type="submit" value="submit">
	</form>
	<?php
	if (isset($error_message)) {
		echo "<p class='error'>Error: $error_message</p>";
	}
	?>
</body>
</html>

