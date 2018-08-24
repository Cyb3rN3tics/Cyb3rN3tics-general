<?php
session_start();
if (isset($_SESSION["is_logged"])){
    header("Location: home.php");
    exit();
}

function clean($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = mysqli_connect("127.0.0.1", "root", "3E9gPzv9TyhyQdBa", "users") or die("Conenction failed");
    $username = clean($_POST["username"]);
    $password = hash("sha256", clean($_POST["password"]));
    $sql = "SELECT uname, password FROM info WHERE (uname='$username' AND password='$password')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1){
        $_SESSION["is_logged"] = true;
        $_SESSION["username"] = $username;
        header("Location: home.php");
    } else {
        $error = "Wrong username or password";
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
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div id="container">
            <span style="color: #ff0000;"></span>
            <form action="login.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <p><a href="#">Forgot your password?</a></p>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
</html>
