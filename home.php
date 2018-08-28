<?php
# we need to change this one to 0 when we are done
error_reporting(E_ALL ^ E_NOTICE);
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
	<!-- load styles depending on the type of the device to reduce the code -->
	<?php if ($_SESSION["is_phone"]){ ?>
		<link rel="stylesheet" type="text/css" href="css/m_static.css">
	<?php } else { ?>
		<link rel="stylesheet" type="text/css" href="css/static.css">
	<?php } ?>
		<link rel="icon" href="img/old_logo.png">
		<script src="js/static.js"></script>
	</head>
	<body>
		<div class="header">
			<div class="div1" onmouseover="over('img/logo.jpg', 'logo');" onmouseout="out('img/logo.png', 'logo');">
				<img id="logo" src="img/logo.png">
				<span>CyberNetics&trade;</span>
			</div>
		<?php if (isset($_SESSION["is_logged"])){ ?>
			<div class="div2" onclick="(function(){window.location = 'dashboard.php';})()" onmouseover="over('img/o_user.png', 'user');" onmouseout="out('img/user.png', 'user');">
				<img id="user" src="img/user.png" title="<?php echo $_SESSION["username"]; ?>">
			</div>
		<?php if ($_SESSION["is_admin"]){ ?>
			<div class="div2" onclick="(function(){window.location = 'edit.php';})()" onmouseover="over('img/o_edit.png', 'edit');" onmouseout="out('img/edit.png', 'edit');">
				<img id="edit" src="img/edit.png" title="CyberNetics&trade; | Edit">
			</div>
		<?php }} else { ?>
			<div class="div2" onclick="(function(){window.location = 'login.php';})()" onmouseover="over('img/o_login.png', 'login');" onmouseout="out('img/login.png', 'login');">
				<img id="login" src="img/login.png" title="CyberNetics&trade; | Login">
			</div>
		<?php } ?>
		</div>
		<div class="main">
			<span>Welcome to CyberNetics&trade; official website</span>
		</div>
	<?php if (isset($_SESSION["is_logged"])){ ?>
		<a href="logout.php">
			<img class="logout" src="img/logout.png" title="CyberNetics&trade; | Logout">
		</a>
	<?php } ?>
	</body>
</html>
