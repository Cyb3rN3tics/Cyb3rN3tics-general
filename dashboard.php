<?php
# we need to change this one to 0 when we are done
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (!isset($_SESSION["is_logged"])){
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION["is_phone"])){
    header("Location: /");
    exit();
}
if (isset($_SESSION["username"])){
    $info = json_decode(file_get_contents("status.json"), true);
    $is_member = (bool)$info[$_SESSION["username"]]["is_member"];
    if (!$is_member){
        header("Location: logout.php");
        exit();
    }
    $is_admin = (bool)$info[$_SESSION["username"]]["is_admin"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CyberNetics&trade; | Dashboard</title>
        <?php if ($_SESSION["is_phone"]){ ?>
            <link rel="stylesheet" type="text/css" href="css/m_static.css">
        <?php } else { ?>
            <link rel="stylesheet" type="text/css" href="css/static.css">
        <?php } ?>
        <link rel="icon" href="img/old_logo.png">
        <script src="js/static.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .dropbtn {
                background-color: #3498DB;
                color: #ffffff;
                padding: 10px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
            }

            .dropbtn:hover, .dropbtn:focus {
                background-color: #2980B9;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                min-width: 160px;
                overflow: auto;
                box-shadow: 0px 8px 16px 0px rgb(0, 0, 0, 0.3);
                z-index: 1;
                border: 1px solid #d7d7d7;
                border-radius: 5px;
            }

            .dropdown-content a {
                color: black;
                padding: 10px 14px;
                text-decoration: none;
                display: block;
                font-size: 14px;
            }

            .dropdown a:hover {
                background-color: #ddd;
            }

            .show {
                display: block;
            }
        </style>
        <script>
            function drop(){
                document.getElementById("myDropdown").classList.toggle("show");
            }
            window.onclick = function(event){
                if (!event.target.matches(".dropbtn")){
                    document.getElementById("myDropdown").classList.remove("show");
                }
            }
        </script>
    </head>
    <body>
        <div class="header">
            <div class="div1" onclick="(function(){window.location = 'home.php';})()" onmouseover="over('img/logo.jpg', 'logo');" onmouseout="out('img/logo.png', 'logo');">
                <img id="logo" src="img/logo.png">
                <span>CyberNetics&trade;</span>
            </div>
            <div class="div2" onmouseover="over('img/o_user.png', 'user');" onmouseout="out('img/user.png', 'user');">
                <img id="user" src="img/user.png" title="<?php echo $_SESSION["username"]; ?>">
            </div>
            <?php if ($is_admin){ ?>
                <div class="div2" onclick="(function(){window.location = 'edit.php';})()" onmouseover="over('img/o_edit.png', 'edit');" onmouseout="out('img/edit.png', 'edit');">
                    <img id="edit" src="img/edit.png" title="CyberNetics&trade; | Edit">
                </div>
            <?php } ?>
        </div>
        <div class="main">
            <div class="dropdown">
                <button onclick="drop();" class="dropbtn">Dropdown <li class="fa fa-caret-down"></li></button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="https://trello.com/b/GQdFrvJ7">Trello</a>
                    <a href="https://github.com/Cyb3rN3tics/Cyb3rN3tics-general-repo.git">GitHub</a>
                    <a href="#">IRC</a>
                </div>
            </div>
        </div>
        <a href="logout.php">
            <img class="logout" src="img/logout.png" title="CyberNetics&trade; | Logout">
        </a>
    </body>
</html>
