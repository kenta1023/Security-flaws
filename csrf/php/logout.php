<?php
session_start();
$_SESSION = array();
session_destroy();
http_response_code(301);
header('Location: login.php');
?>
