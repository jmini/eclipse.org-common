<?php
$set = $_GET['set'];
$domain = $_SERVER['HTTP_HOST'];
setcookie ('sitestyle', $set, time()+31536000, '/', $domain, '0');
$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
header("Location: $HTTP_REFERER");
?>