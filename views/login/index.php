<?php
//require_once './controllers/LoginController.php';
require_once './vendor/autoload.php';

use LoginController\LoginController;

$controller=new LoginController();

require_once './views/selectedaction.php';
?>
