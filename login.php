<?php
include 'includes/config.php';
Database::initialize();
session_start();
$errors = array(); //Logging in existing user 
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$username = mysqli_real_escape_string(Database::$conn, $username);
	$password = mysqli_real_escape_string(Database::$conn, $password);
	$passworde = md5($password);
	$result = mysqli_query(Database::$conn, "SELECT * from users where username='$username' and password='$passworde' ") or die(" failed to query database" . mysqli_error());
	$row = mysqli_fetch_array($result);
	if ($row['username'] == $username && $row['password'] == $passworde) {
		echo "Welcome " . $row['username'];
		$_SESSION['department'] = $row['department'];
		echo " <br> You are in the department of " . $row['department'];
		$_SESSION['gwaliusername'] = $username;
		$_SESSION['firstname'] = $row['firstname'];
		$_SESSION['Timeleft'] = $row['Timeleft'];
		header('location: chem.php');
	} else {
		echo "
		<small>Username and password do not match</small>";
	}
} else if (isset($_POST['logout'])) {
	session_destroy();
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>LOG IN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="bg-contact2" style="background-image: url('images/br0.jpg'); background-size:cover">
		<div class="container-contact2">
			<div class="wrap-contact2">
				<form class="contact2-form validate-form" action="login.php" method="POST" onsubmit="summit()">
					<span class="contact2-form-title">
						LOG IN
					</span>

					<div class="wrap-input2 validate-input" data-validate="Userame is required">
						<input class="input2" type="text" name="username" required>
						<span class="focus-input2" data-placeholder="NAME"></span>
					</div>

					<div class="wrap-input2 validate-input" data-validate="password is required">
						<input class="input2" type="password" name="password" required>
						<span class="focus-input2" data-placeholder="PASSWORD"></span>
					</div>
					<div class="container-contact2-form-btn">
						<div class="wrap-contact2-form-btn">
							<div class="contact2-form-bgbtn"></div>
							<input type="submit" value="submit" name="submit"><br>
						</div>
					</div>
					Dont have an account?<br>
					<a href="signup.php">Register Here</a>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>