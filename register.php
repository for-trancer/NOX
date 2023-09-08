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
	<title>NOX | SIGN UP</title>
	<link rel="StyleSheet" href="css/style.css">
	</head>
	<body>
		<?php

		$server = "localhost";
		$user = ""; // mysql username
		$pass = ""; //  mysql password
		$db = ""; // mysql database

		$conn = new mysqli($server,$user,$pass,$db);

		$username = $email = $password = $confirm = "";
		$usernameErr = $emailErr = $passwordErr = $confirmErr = $sqlErr = "";

		$isValid = true;

		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			if(empty($_POST["username"]))
			{
				$isValid = false;
				$usernameErr = "*username is required!";
			}
			else
			{
				$username = Formatter($_POST["username"]);
				if(!(strlen($username)>=3))
				{
					$isValid = false;
					$usernameErr = "*length of username is short";
				}
				else
				{
					if(!preg_match("/^[a-z\d_]{3,30}$/i",$username))
					{
						$isValid = false;
						$usernameErr = "*username can contain only small letters and numbers!";
					}
					else
					{
						$result = $conn->query("select username from users where username='$username';");
						if($result->num_rows>0)
						{
							$isValid = false;
							$usernameErr = "*username already exists!";
						}
					}
				}
			}
			if(empty($_POST["email"]))
			{
				$isValid = false;
				$emailErr = "*email is required!";
			}
			else
			{
				$email = Formatter($_POST["email"]);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$isValid = false;
					$emailErr = "*email format is incorrect!";
				}
				else
				{
					$r = $conn->query("SELECT email FROM USERS WHERE EMAIL='$email';");
					if($r->num_rows>0)
					{
						$isValid = false;
						$emailErr = "*email already exists!";
					}
				}
			}
			if(empty($_POST["password"]))
			{
				$isValid = false;
				$passwordErr = "*password is required";
			}
			else
			{
				$password = $_POST["password"];
				if(!(strlen($password)>7))
				{
					$isValid = false;
					$passwordErr = "*password must have atleast a length of 8!";
				}
			}
			if(!empty($_POST["password"]))
			{
				if(empty($_POST["confirm"]))
				{
					$isValid = false;
					$confirmErr = "*confirm your password!";
				}
				else
				{
					$confirm = $_POST["confirm"];
					if(!($confirm==$password))
					{
						$isValid = false;
						$confirmErr = "*passwords doesn't match!";
					}
				}
			}
			if($conn->connect_error)
			{
			$isValid = false;
			$sqlErr = "*connection error!";
			}
			

			if($isValid)
			{
				$query = "INSERT INTO users VALUES(?,?,?);";

				$securepassword = password_hash($password,PASSWORD_DEFAULT);

				$stmt = $conn->prepare($query);

				$stmt->bind_param("sss",$username,$email,$securepassword);

				$stmt->execute();

				header("Location: index.php");
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
			<h1>REGISTER</h1>
			</div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<label for="username">Username</label>
				<br>
				<input type="text" name="username" value="<?php echo $username;?>">
				<br>
				<div class="error"><?php echo $usernameErr;?></div>
				<br>
				<label for="email">Email</label>
				<br>
				<input type="text" name="email" value="<?php echo $email;?>">
				<br>
				<div class="error"><?php echo $emailErr;?></div>
				<br>
				<label for="password">Password</label>
				<br>
				<input type="password" name="password" value="<?php echo $password;?>">
				<br>
				<div class="error"><?php echo $passwordErr;?></div>
				<br>
				<label for="confirm">Confirm Password</label>
				<br>
				<input type="password" name="confirm">
				<br>
				<div class="error"><?php echo $confirmErr;?></div>
				<br>
				<div class="error"><?php echo $sqlErr;?></div>
				<br>
				<input type="submit" class="btn">
		</form>
		<br>
		<input type="button" class="btn" onClick="javascript:window.location.href='login.php'" value="Login Here!">
		<br>
	</div>
	<br>
	<br>
	</body>
</html>
