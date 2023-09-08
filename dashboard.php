<?php
	session_start()
?>
<!DOCTYPE html>
<html>
	<head>
		<meta encoding="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>NOX | DASHBOARD</title>
		<link rel="StyleSheet" href="css/style.css">
	</head>
	<body>
			<?php
				if(isset($_SESSION["user"]))
				{
					$user = $_SESSION["user"];
				}
				else
				{
					header("Location: login.php");
					close();
				}

				$imageErr = $imageErr2 = $imageErr3 = "";
				$directory = "avatars/";
				$uploadOk = true;
				$imageUrl=$directory.$user.".png";
				$imageLoc="";

				if(file_exists($imageUrl))
				{
					$imageLoc=$imageUrl;
				}
				else
				{
					$imageLoc = "avatars/avatar.png";
				}

				if(isset($_POST["submit"]))
				{
					$file = $directory . $user;
					$tmp_name = $directory . basename($_FILES["upload"]["name"]);
					$extension = strtolower(pathinfo($tmp_name,PATHINFO_EXTENSION));


					if($_FILES["upload"]["size"]>500000)
					{
						$uploadOk = false;
						$imageErr = "*file size should be less than 500kb!";
					}

					if($extension!="jpg"&&$extension!="png"&&$extension!="jpeg"&&$extension!="gif")
					{
						$uploadOk = false;
						$imageErr2 = "*image should be JPG,PNG,JPEG or GIF!";
					}

					if(!$uploadOk)
					{
						$imageErr3=$imageErr2;
						$imageErr2=$imageErr;
						$imageErr="*image could not be uploaded!";
					}
					else
					{
						$file_name = $file ."."."png";
						move_uploaded_file($_FILES["upload"]["tmp_name"],$file_name);
						$imageLoc = $file_name;
					}

				}
			?>
			<div class="container">
				<div class="text-holder">
					<h1>DASHBOARD</h1>
				</div>
				<img src="<?php echo $imageLoc;?>" class="image">
				<h3>Welcome , <?php echo $user?></h3>
		    	<div class="uploader">
		    		<h4>Upload Avatar</h4>
		    	   	 <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
		    			<input type="file" name="upload" id="upload">
		    			<div class="error"><?php echo $imageErr."<br>".$imageErr2."<br>".$imageErr3; ?></div>
		    			<input type="submit" value="Upload" name="submit" class="btn">
		    			</form>
				</div>
				<br>
				<input type="button" class="btn" value="Log Out" onClick="javascript:window.location.href='logout.php'">
				<br>
			</div>
			<div class="footer">&copy2020 - <?php echo date("Y")?> | Developed By FORTRANCER</div>
			<br>
			<br>
		</body>
	</head>
</html>