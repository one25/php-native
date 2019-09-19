<?php
namespace CartController;

//require_once './models/model_goods.php';
require_once './vendor/autoload.php';

use GoodsModel\Goods;

class CartController {

protected $model_goods;

public function __construct()
{
   $this->model_goods = new Goods;
}

public function actionCart($id)
{
   $cart = $this->model_goods->funcSelect($id);
   require_once './views/cart/view.php';
}

}

?>
