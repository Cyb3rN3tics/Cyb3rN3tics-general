<?php
session_start();
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
        print "found";
        $_SESSION["is_logged"] = true;
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
    } else {
        print "not found";
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
        <title>Login</title>
        <link rel="stylesheet" href="css/static.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="header">
			<a href="home.php">
				<img src="img/logo.jpg" class="logo">
				<h1>CyberNetics&trade;</h1>
			</a>
            <a href="login.php">
				<img src="img/login.png" style="height: 40px; width: 40px; margin: 7px 5px 0 5px; float: right;">
			</a>
        </div>
        <center>
            <div class="main">
                <span><?php if (isset($_SESSION["error"])){ echo $_SESSION["error"]; } else { echo ""; } ?></span>
                <form action="login.php" method="post">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" required><br>
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" required><br>
                    <input type="submit" value="Login">
                </form>
            </div>
        </center>
    </body>
</html>
<?php unset($_SESSION["error"]); ?>
