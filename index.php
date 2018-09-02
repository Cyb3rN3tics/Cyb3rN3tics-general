<?php
session_start();
include 'check.php';
if (is_mobile()){
    $_SESSION["is_phone"] = true;
}
else {
    $_SESSION["is_phone"] = false;
}
header("Location: home.php");
exit();
?>
