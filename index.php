<?php
session_start();
function is_mobile(){
    return preg_match("/(android|kik|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|boost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
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
