
    <!DOCTYPE html>
<html>
<head>
	<title>User Registration Form</title>
	<style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		
		label {
			font-weight: bold;
			margin-bottom: 5px;
		}
		
		input[type="text"],
		input[type="email"],
		input[type="password"] {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 10px;
			width: 300px;
			font-size: 16px;
		}
		
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			margin-top: 20px;
			margin-bottom: 10px;
			width: 200px;
			transition: all 0.2s ease-in-out;
		}
		
		input[type="submit"]:hover {
			background-color: #3e8e41;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		}
		
		a {
			text-decoration: none;
			font-size: 14px;
			color: #333;
		}
		
		a:hover {
			color: #4CAF50;
		}
		
		h2 {
			text-align: center;
			margin-top: 50px;
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
	<h2>User Registration Form</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="first_name">First Name:</label>
		<input type="text" id="first_name" name="first_name">
		
		<label for="last_name">Last Name:</label>
		<input type="text" id="last_name" name="last_name">
		
		<label for="email">Email:</label>
		<input type="email" id="email" name="email">
		
		<label for="password">Password:</label>
		<input type="password" id="password" name="password">
		
		<label for="confirm_password">Confirm Password:</label>
		<input type="password" id="confirm_password" name="confirm_password">
		
		<input type="submit" value="Submit">
		<a href="http://localhost:8012/mac/login.php">Click here to login</a>

	</form>
</body>
</html>

    <?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password1 = "Varshith@1511";
$dbname = "dblab8";

$conn = mysqli_connect($servername, $username, $password1, $dbname);

// Check if the connection was successful
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirm_password = $_POST["confirm_password"];
	
	// Validate the form data
	if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
		echo "Please fill in all fields.";
	} elseif ($password != $confirm_password) {
		echo "Passwords do not match.";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email address.";
	} elseif (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
		echo "Password must be at least 8 characters long and contain at least a letter and a number";
	} 
	 else {
		// Hash the password for security
		
		// Insert the user data into the database
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";
		
		if (mysqli_query($conn, $sql)) {
			echo "<strong>registration successfull!!</strong>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

?>


    
   
    