<?php
namespace BuyController;

//require_once './models/model_goods.php';
//require_once './models/model_api.php';
//require_once './models/model_buy.php';
require_once './vendor/autoload.php';

use GoodsModel\Goods;
use ApiModel\Api;
use BuyModel\Buy;

class BuyController {

protected $model_goods;
protected $model_api;
protected $model_buy;

public function __construct()
{
   $this->model_goods = new Goods;
   $this->model_api = new Api;
   $this->model_buy = new Buy;
}

public function actionBuy($id)
{
   $cart = $this->model_goods->funcSelect($id);

   require_once './views/buy/view.php';
}

public function actionSend($id)
{
   if($this->model_api->mailerOrderValidation()) {
      if($this->model_buy->mailerBuyValidation($_POST['name'], $_POST['email'], $_POST['phone'])) {
         $result_email = json_decode($this->model_api->mailerOrder($this->model_goods->funcSelect($id), $_POST['name'], $_POST['email'], $_POST['phone']));
         $_SESSION['mail_result'] = $result_email->mail;
      }
      else {
         $_SESSION['name_old'] = $_POST['name'];
         $_SESSION['email_old'] = $_POST['email'];
         $_SESSION['phone_old'] = $_POST['phone'];
         $_SESSION['message_error'] = $this->model_buy->error_validation;
      }
   }
   else {
      $_SESSION['mail_error'] = "You can not use this option!";
   }
   header('location:?page=buy&hook=Buy/' . $id);
}

}

?>
