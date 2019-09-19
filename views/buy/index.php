<?php
//require_once './controllers/BuyController.php';
require_once './vendor/autoload.php';

use BuyController\BuyController;

$controller=new BuyController();

require_once './views/selectedaction.php';
?>
