<?php
session_start();
include 'check.php';
if (is_mobile()){
    $_SESSION["is_phone"] = true;
}
else {
    $_SESSION["is_phone"] = false;
}
$referer = $_SERVER["HTTP_REFERER"];
if (isset($referer)){
    header("Location: $referer");
}
else {
    header("Location: home.php");
}
exit();
?>
