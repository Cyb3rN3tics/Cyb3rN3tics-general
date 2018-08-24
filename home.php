<?php
session_start();
if (!isset($_SESSION["is_phone"])){
	header("Location: /");
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CyberNetics&trade; | Home</title>
		<link rel="stylesheet" type="text/css" href="static.css">
		<link rel="icon" href="logo.jpg">
	</head>
	<body>
	<?php if ($_SESSION["is_phone"]){ ?>
		<div style="position: fixed; background-color: #000000; top: 0; left: 0; right: 0; border-bottom: 1px solid #ffffff;">
			<a href="">
				<img src="logo.jpg" style="width: 35px; height: 35px; float: left;">
				<h3 style="color: #ffffff; float: left; margin: 7px 0 0 5px;">CyberNetics&trade;</h3>
			</a>
		<?php if (isset($_SESSION["is_logged"])){ ?>
			<img src="user.png" style="height: 30px; width: 30px; float: right; margin-top: 3px; margin-right: 2px;">
		<?php } else { ?>
			<a href="login.php">
				<img src="login.png" style="height: 30px; width: 30px; float: right; margin-top: 3px; margin-right: 2px;">
			</a>
		<?php } ?>
		</div>
		<center>
			<div style="margin-top: 50px; background-color: #ffffff; border: 1px solid #000000; border-radius: 5px;">
				<h3>Welcome to CyberNetics&trade; official website</h3>
			</div>
		</center>
	<?php if (isset($_SESSION["is_logged"])){ ?>
		<a href="logout.php">
			<img src="logout.png" style="position: fixed; bottom: 5px; right: 5px; background-color: #000000; border: 1px solid #ffffff; border-radius: 100%; height: 30px; width: 30px; padding: 3px;">
		</a>
	<?php } ?>
	<?php } else { ?>
		<div class="header">
			<a href="" title="CyberNetics&trade; | Home">
				<img class="logo" src="logo.jpg">
				<h1>CyberNetics&trade;</h1>
			</a>
		<?php if (isset($_SESSION["is_logged"])){ ?>
			<img src="user.png" title="<?php echo $_SESSION["username"]; ?>" style="height: 40px; width: 40px; float: right; margin: 7px 5px 0 5px;">
		<?php } else { ?>
			<a href="login.php" style="float: right;">
				<img src="login.png" style="height: 40px; width: 40px; margin: 7px 5px 0 5px;">
			</a>
		<?php } ?>
		</div>
		<center>
			<div class="main">
				<h2 style="cursor: default;">Welcome to CyberNetics&trade; official website</h2>
			</div>
		</center>
		<?php if (isset($_SESSION["is_logged"])){ ?>
			<a href="logout.php">
				<img src="logout.png" title="Logout" style="position: fixed; bottom: 10px; right: 10px; background-color: #000000; border: 1px solid #ffffff; border-radius: 100%; height: 40px; width: 40px; padding: 3px;">
			</a>
		<?php } ?>
	<?php } ?>
	</body>
</html>
