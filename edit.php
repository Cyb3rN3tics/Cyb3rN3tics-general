<?php
session_start();
if (!isset($_SESSION["is_phone"])){
	header("Location: /");
	exit();
}
if (!isset($_SESSION["is_admin"]) || $_SESSION["is_admin"]){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CyberNetics&trade; | Edit</title>
		<link rel="stylesheet" type="text/css" href="css/static.css">
		<link rel="icon" type="image/png" href="img/o_logo.png">
	</head>
	<body>
		<?php if ($_SESSION["is_phone"]){ ?>
		<div class="header">
			<a href="home.php">
				<img src="img/logo.png" class="m_logo">
				<h3>CyberNetics&trade;</h3>
			</a>
            <img id="m_user" src="user.png">
		</div>
		<center>
			<div style="margin-top: 100px; background-color: #ffffff; border: 1px solid #000000; border-radius: 5px;">
				<h3></h3>
			</div>
		</center>
		<a href="logout.php">
			<img src="img/logout.png" style="position: fixed; bottom: 5px; right: 5px; background-color: #000000; border: 1px solid #ffffff; border-radius: 100%; height: 30px; width: 30px; padding: 3px;">
		</a>
		<?php } else { ?>
		<div class="header">
			<a href="home.php" title="CyberNetics&trade; | Edit">
				<img class="logo" src="img/logo.png">
				<h1>CyberNetics&trade;</h1>
			</a>
			<img src="img/user.png" title="<?php echo $_SESSION["username"]; ?>" style="height: 40px; width: 40px; float: right; margin: 7px 5px 0 5px;">
			<a href="login.php">
				<img src="img/login.png" style="height: 40px; width: 40px; margin: 7px 5px 0 5px; float: right;">
			</a>
		</div>
		<center>
			<div class="main">
				<h2 style="cursor: default;">Welcome to CyberNetics&trade; official website</h2>
			</div>
		</center>
		<a href="logout.php">
			<img src="img/logout.png" title="Logout" style="position: fixed; bottom: 10px; right: 10px; background-color: #000000; border: 1px solid #ffffff; border-radius: 100%; height: 40px; width: 40px; padding: 3px;">
		</a>
		<?php } ?>
	</body>
</html>
