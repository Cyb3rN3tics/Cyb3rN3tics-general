<?php
session_start();
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
    $conn = mysqli_connect("127.0.0.1", "root", "3E9gPzv9TyhyQdBa", "users") or die("Conenction failed");
    $username = clean($_POST["username"]);
    $password = hash("sha256", clean($_POST["password"]));
    $sql = "SELECT uname, password FROM info WHERE (uname='$username' AND password='$password')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1){
        $_SESSION["is_logged"] = true;
        $_SESSION["username"] = $username;
		$_SESSION["is_admin"] = mysqli_fetch_assoc($result)["is_admin"];
        header("Location: dashboard.php");
    } else {
        $_SESSION["error"] = "Wrong username or password";
        header("Location: login.php");
    }
    mysqli_close($conn);
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Commpatible" content="IE=edge, chrome=1">
        <title>CyberNetics&trade; | Login</title>
        <link rel="stylesheet" type="text/css" href="css/static.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="icon" href="img/o_logo.png">
    </head>
    <body>
        <?php if ($_SESSION["is_phone"]){ ?>
        <div class="header">
			<a href="home.php">
				<img src="img/logo.png" class="m_logo">
				<h3>CyberNetics&trade;</h3>
			</a>
    	</div>
        <center>
            <div style="margin-top: 100px; background-color: #ffffff; border: 1px solid #000000; border-radius: 5px; padding: 20px;">
                <span><?php if (isset($_SESSION["error"])){ echo $_SESSION["error"]; } else { echo ""; } ?></span>
                <form action="login.php" method="post">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" required placeholder="Username" maxlength="10"><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required placeholder="Password" maxlength="30"><br>
                    <input type="submit" value="Login">
                </form>
            </div>
        </center>
        <?php } else { ?>
        <div class="header">
			<a href="home.php">
				<img src="img/logo.png" class="logo">
				<h1>CyberNetics&trade;</h1>
			</a>
        </div>
        <center>
            <div class="main">
                <span><?php if (isset($_SESSION["error"])){ echo $_SESSION["error"]; } else { echo ""; } ?></span>
                <form action="login.php" method="post">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" required placeholder="Username" maxlength="10"><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required placeholder="Password" maxlength="30"><br>
                    <input type="submit" value="Login">
                </form>
            </div>
        </center>
        <?php } ?>
    </body>
</html>
<?php unset($_SESSION["error"]); ?>
