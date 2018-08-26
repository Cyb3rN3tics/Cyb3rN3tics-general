<?php
session_start();
if (!isset($_SESSION["is_logged"])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example<span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="https://trello.com/b/GQdFrvJ7">Trello</a></li>
                <li><a href="https://github.com/Cyb3rN3tics/Cyb3rN3tics-general-repo.git">GitHub</a></li>
                <li><a href="#">IRC</a></li>
            </ul>
        </div>
    </body>
</html>
