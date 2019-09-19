<?php
session_start();
if(isset($_GET['page'])) {$patch = 'views/' . $_GET['page'] . '/index.php';}
else {$patch = 'views/login/index.php';}
(file_exists($patch)) ? require $patch : require 'views/404/404.php';
?>
