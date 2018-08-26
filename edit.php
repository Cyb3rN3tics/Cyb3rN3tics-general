<?php
session_start();
# we need to change this one to 0 when we are done
error_reporting(E_ALL ^ E_NOTICE);
$error = "";
$is_main = 0;
if (!isset($_SESSION["is_phone"]) || !$_SESSION["is_admin"]){
	header("Location: /");
	exit();
}
function clean($data){
	return htmlspecialchars(stripslashes(trim($data)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$conn = mysqli_connect("127.0.0.1", "root", "3E9gPzv9TyhyQdBa", "users") or die("Conenction failed");
	$username = clean($_POST["username"]);
	if (isset($_POST["password"])){
		$password = hash("sha256", clean($_POST["password"]));
	} else {
		$password = 0;
	}
	$is_admin = (bool)$_POST["admin"];
	if ($is_main){
		if (!preg_match("^[a-zA-Z0-9]*", $username)){
			$sql = "SELECT uname FROM info WHERE uname='$username'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0){
				$error = "Username already exists";
			} else {
				$sql = "INSERT INTO info (uname, password, is_admin) VALUES ('$username', '$password', '$is_admin')";
				mysqli_query($conn, $sql);
			}
		} else {
			$error = "Only letters and numbers allowed";
		}
	} else {
		if ($password){
			$sql = "UPDATE info SET password='$password', is_admin='$is_admin' WHERE uname='$username'";
		} else {
			$sql = "UPDATE info SET is_admin='$is_admin' WHERE uname='$username'";
		}
		mysqli_query($conn, $sql);
	}
	mysqli_close($conn);
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit"])){
	$conn = mysqli_connect("127.0.0.1", "root", "3E9gPzv9TyhyQdBa", "users") or die("Connection failed");
	$sql = "SELECT uname, is_admin FROM info";
	$result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CyberNetics&trade; | Edit</title>
	<!-- load styles depending on the type of the device to reduce the code -->
	<?php if ($_SESSION["is_phone"]){ ?>
		<link rel="stylesheet" type="text/css" href="css/m_static.css">
	<?php } else { ?>
		<link rel="stylesheet" type="text/css" href="css/static.css">
	<?php } ?>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="icon" type="image/png" href="img/old_logo.png">
		<script src="js/static.js"></script>
	</head>
	<body>
		<div class="header">
			<div class="div1" onmouseover="over('img/logo.jpg', 'logo');" onmouseout="out('img/logo.png', 'logo');">
				<img id="logo" src="img/logo.png">
				<span>CyberNetics&trade;</span>
			</div>
			<div class="div2" onclick="(function(){window.location = 'dashboard.php';})()" onmouseover="over('img/o_user.png', 'user');" onmouseout="out('img/user.png', 'user');">
				<img id="user" src="img/user.png" title="<?php echo $_SESSION["username"]; ?>">
			</div>
		</div>
		<div class="main">
			<span style="color: #ff0000; font-size: 20px;"><?php echo $error; ?></span><br>
		<?php if (!isset($_GET["insert"]) && !isset($_GET["edit"]) && !isset($_GET["username"])){ ?>
			<button type="button" onclick="(function(){window.location = 'edit.php?insert=1';})()">Insert</button>
			<button type="button" onclick="(function(){window.location = 'edit.php?edit=1';})()">Edit</button>
		<?php } else if (isset($_GET["insert"])){ $is_main = 1; ?>
			<form action="edit.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required placeholder="Username" maxlength="10"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required placeholder="Password" maxlength="30"><br>
				<label for="admin" style="margin-right: 30%;">Admin status:</label><br>
				<input type="radio" name="admin" value="1">True
				<input type="radio" name="admin" value="0" checked>False<br>
                <input type="submit" value="Insert">
            </form>
		<?php } else
			if (isset($_GET["edit"])){
				while ($row = mysqli_fetch_assoc($result)) {
					echo "\t\t\t<div style=\"border-top: 1px dotted #000000; padding: 5px 0 0 0;\">\n\t\t\t\t<span style=\"font-size: 16px; float: left; margin-top: 5px;\">".$row["uname"]."</span><button type=\"button\" style=\"float: right; margin-top: 0;\" onclick=\"(function(){window.location = 'edit.php?username=".$row["uname"]."&is_admin=".$row["is_admin"]."';})()\" title=".$row["uname"].">Edit</button></div><br><br>\n";
				}
			} else if (isset($_GET["username"])){ $is_main = 0; ?>
			<form action="edit.php" method="post">
				<label for="username">Username:</label><br>
				<input type="text" name="username" required value="<?php echo $_GET["username"]; ?>" readonly><br>
				<label for="password" style="margin-right: 77.2%;">Change the Password:</label><br>
                <input type="password" id="password" name="password" placeholder="Password" maxlength="30"><br>
				<label for="admin" style="margin-right: 30%;">Admin status:</label><br>
				<input type="radio" name="admin" value="1" <?php if ($_GET["is_admin"]){ echo "checked"; } ?>>True
				<input type="radio" name="admin" value="0" <?php if (!$_GET["is_admin"]){ echo "checked"; } ?>>False<br>
				<input type="submit" value="Insert">
			</form>
		<?php } ?>
		</div>
		<a href="logout.php">
			<img class="logout" src="img/logout.png" title="CyberNetics&trade; | Logout">
		</a>
	</body>
</html>
