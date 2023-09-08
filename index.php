<?php
	session_start();
	if(isset($_SESSION["user"]))
	{
		header("Location: dashboard.php");
		close();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>NOX | HOME</title>
		<link rel="StyleSheet" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<div class="text-holder">
			<h2>WELCOME TO</h2>
			<h1>NOX</h1>
			</div>
			<input type="button" name="login" value="Sign In" onClick="javascript:window.location.href='login.php';" class="btn">
			<br>
			<input type="button" name="register" value="Sign Up" onClick="javascript:window.location.href='register.php';" class="btn">
		<br>
		<br>
		</div>
	</body>
</html>