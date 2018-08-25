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
		<link rel="stylesheet" type="text/css" href="css/static.css">
		<link rel="icon" type="image/png" href="img/o_logo.png">
		<script>
			function over(url, id){
				document.getElementById(id).src = url;
			}
			function out(url, id){
				document.getElementById(id).src = url;
			}
		</script>
	</head>
	<body>
		<?php if ($_SESSION["is_phone"]){ ?>
		<div class="header">
			<div>
				<a href="">
					<img src="img/logo.png" class="m_logo">
					<h3>CyberNetics&trade;</h3>
				</a>
			</div>
		<?php if (isset($_SESSION["is_logged"])){ ?>
			<img id="m_user" src="user.png">
		<?php } else { ?>
		<?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]){ ?>
			<a href="edit.php">
				<img class="m_img" src="img/edit.png">
			</a>
		<?php } ?>
			<a href="login.php">
				<img class="m_img" src="img/login.png">
			</a>
		<?php } ?>
		</div>
		<center>
			<div style="margin-top: 100px; background-color: #ffffff; border: 1px solid #000000; border-radius: 5px;">
				<h3>Welcome to CyberNetics&trade; official website</h3>
			</div>
		</center>
		<?php if (isset($_SESSION["is_logged"])){ ?>
		<a href="logout.php">
			<img src="img/logout.png" style="position: fixed; bottom: 5px; right: 5px; background-color: #000000; border: 1px solid #ffffff; border-radius: 100%; height: 30px; width: 30px; padding: 3px;">
		</a>
		<?php }} else { ?>
		<div class="header">
			<div class="div1" onmouseover="over('img/o_logo.png', 'logo');" onmouseout="out('img/logo.png', 'logo');">
				<img id="logo" src="img/logo.png">
				<h1>CyberNetics&trade;</h1>
			</div>
		<?php if (isset($_SESSION["is_logged"])){ ?>
			<div class="div2" onclick="(function(){window.location = 'dashboard.php';})()" onmouseover="over('img/o_user.png', 'user');" onmouseout="out('img/user.png', 'user');">
				<img id="user" src="img/user.png" title="<?php echo $_SESSION["username"]; ?>" style="height: 40px; width: 40px; float: right; margin: 7px 5px 0 5px;">
			</div>
		<?php } else { if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]){ ?>
			<div class="div2" onclick="(function(){window.location = 'edit.php';})()" onmouseover="over('img/o_edit.png', 'edit');" onmouseout="out('img/edit.png', 'edit');">
				<img id="edit" src="img/edit.png" style="height: 40px; width: 40px; margin: 7px 5px 0 5px; float: right;">
			</div>
		<?php } ?>
			<div class="div2" onclick="(function(){window.location = 'login.php';})()" onmousemove="over('img/o_login.png', 'login');" onmouseout="out('img/login.png', 'login');">
				<img id="login" src="img/login.png" style="height: 40px; width: 40px; margin: 7px 5px 0 5px; float: right;">
			</div>
		<?php } ?>
		</div>
		<center>
			<div class="main">
				<h2 style="cursor: default;">Welcome to CyberNetics&trade; official website</h2>
			</div>
		</center>
		<?php if (isset($_SESSION["is_logged"])){ ?>
		<a href="logout.php">
			<img src="img/logout.png" title="Logout" style="position: fixed; bottom: 10px; right: 10px; background-color: #000000; border: 1px solid #ffffff; border-radius: 100%; height: 40px; width: 40px; padding: 3px;">
		</a>
		<?php }} ?>
	</body>
</html>
