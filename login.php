<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="css/loginform.css">
    </head>
    
    <div class="container">
    <div class="row login block-lg">
    <div class="col-md-4 col-md-offset-4">    
    <div class="panel panel-default">
        <div class="panel-body">
    <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>
</html>



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



