<?php
# we need to change this one to 0 when we are done
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$error = "";
if (!isset($_SESSION["is_phone"])){
	header("Location: /");
	exit();
}
if (isset($_SESSION["is_logged"])){
	header("Location: dashboard.php");
	exit();
}
function clean($data){
	return htmlspecialchars(stripslashes(trim($data)));
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = mysqli_connect("localhost", "cybernetics", "sTuKotES&ichEH9DO0eb", "users") or die("Conenction failed");
    $username = clean($_POST["username"]);
    $password = strtoupper(hash("sha256", clean($_POST["password"])));
    $sql = "SELECT * FROM info WHERE (uname='$username' AND password='$password')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1){
        $_SESSION["is_logged"] = true;
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
		exit();
    } else {
        $error = "Wrong username or password";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Commpatible" content="IE=edge, chrome=1">
        <title>CyberNetics&trade; | Login</title>
	<?php if ($_SESSION["is_phone"]){ ?>
		<link rel="stylesheet" type="text/css" href="css/m_static.css">
	<?php } else { ?>
		<link rel="stylesheet" type="text/css" href="css/static.css">
	<?php } ?>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="icon" href="img/old_logo.png">
		<script src="js/static.js"></script>
    </head>
    <body>
		<div class="header">
			<div class="div1" onmouseover="over('img/logo.jpg', 'logo');" onmouseout="out('img/logo.png', 'logo');">
				<img id="logo" src="img/logo.png">
				<span>CyberNetics&trade;</span>
			</div>
		</div>
        <div class="main">
            <span style="color: #ff0000; font-size: 20px;"><?php echo $error; ?></span>
            <form action="login.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required placeholder="Username" maxlength="10"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required placeholder="Password" maxlength="30"><br>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
</html>
