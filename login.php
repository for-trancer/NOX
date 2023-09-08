<?php 
	session_start();
	if(isset($_SESSION["user"]))
	{
		header("Location: dashboard.php");
		close();
	}
?>
<!DOCTYPE html>
<head>
	<meta encoding="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>NOX | LOGIN</title>
	<link rel="StyleSheet" href="css/style.css">
	</head>
<body>
	<?php

	$server = "localhost";
	$user = "root";
	$pass = "root";
	$db = "fortrancer";

	$username = $password = "";
	$usernameErr = $passwordErr = $sqlErr = "";
	$isValid = true;

	$conn = new mysqli($server,$user,$pass,$db);

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if($conn->connect_error)
		{
			$isValid = false;
			$sqlErr = "*connection error!";
		}

		if(empty($_POST["username"]))
		{
			$isValid = false;
			$usernameErr = "*enter the username!";
		}
		else
		{
			$username = Formatter($_POST["username"]);

			$result = $conn->query("SELECT username FROM users WHERE username='$username';");

			if(!($result->num_rows>0))
			{
				$isValid = false;
				$usernameErr = "*username doesn't exist!";
				$username = "";
			}
		}

		if(empty($_POST["password"]))
		{
			$isValid = false;
			$passwordErr = "*password required!";
		}
		else
		{
			if($isValid)
			{
				$password = $_POST["password"];

				$result = $conn->query("SELECT password FROM users WHERE username='$username';");
				$row = $result->fetch_assoc();
				if($result->num_rows>0)
				{
					$hashed_password = $row["password"];
					$check = password_verify($password,$hashed_password);
					if(!$check)
					{
						$isValid = false;
						if(!empty($username))
						{
							$passwordErr = "Password Incorrect!";
						}
					}
				}
				else
				{
					$isValid = false;
					$passwordErr = "Password Incorrect!";
				}
			}
		}
		if($isValid)
		{
			$_SESSION["user"]="$username";
			header("Location: dashboard.php");
			close();
		}
	}


	function Formatter($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>
	<div class="container">
		<div class="text-holder">
			<h1>Login</h1>
		</div>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<label for="username">Username</label>
			<br>
			<input type="text" name="username" value="<?php echo $username;?>">
			<br>
			<div class="error"><?php echo $usernameErr;?></div>
			<br>
			<label for="password">Password</label>
			<br>
			<input type="password" name="password">
			<br>
			<div class="error"><?php echo $passwordErr;?></div>
			<br>
			<div class="error"><?php echo $sqlErr;?></div>
			<br>
			<input type="submit" value="Login" class="btn">
			<br>
			<br>
			<input type="button" class="btn" onClick="javascript:window.location.href='register.php'" value="Register Here!">
			<br>
		</form>
		<br>
	</div>
	<br>
	<br>
</body>
</html>