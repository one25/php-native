<?php
namespace LoginController;

//require_once './models/model_goods.php';
//require_once './models/model_upload.php';
//require_once './models/model_api.php';
require_once './vendor/autoload.php';

use GoodsModel\Goods;
use UploadModel\Upload;
use ApiModel\Api;

class LoginController {

protected $model_goods;
protected $model_upload;
protected $model_api;
protected $message_error;

public function __construct()
{
   $this->model_goods = new Goods;
   $this->model_upload = new Upload;
   $this->model_api = new Api;
}

protected function actionStartView()
{
   $this->model_goods->funcStart();
   $arr_goods = $this->model_goods->row_db;
   $message_error = $this->message_error;
   require_once './views/login/view.php';
}

public function actionStart() {
    if(isset($_SESSION['login'])) {
       $this->actionStartView();
    }
    else {
       require_once './views/login/login.php';
    }
}

public function actionLogin() {
    if($this->model_goods->funcLogin($_POST['username'], $_POST['userpass'])) {
       $_SESSION['login'] = $_POST['username'];
       header('location:index.php');
    }
    else {
       $login_error = 'Bad login or password!';
       require_once './views/login/login.php';
    }
}

public function actionInsert()
{
    if($this->model_goods->insertValidate($_POST['textinsert_marka'], $_POST['textinsert_model'], $_POST['textinsert_price'], $_POST['textinsert_image'])) {
       $res = $this->model_goods->funcInsert($_POST['textinsert_marka'], $_POST['textinsert_model'], $_POST['textinsert_price'], $_POST['textinsert_image']);
       if($res) {
          $_SESSION['message_insert'] = 'Item was inserted...';
       }
    }
    else {
       $_SESSION['marka_old'] = $_POST['textinsert_marka'];
       $_SESSION['model_old'] = $_POST['textinsert_model'];
       $_SESSION['price_old'] = $_POST['textinsert_price'];
       $_SESSION['message_error'] = $this->model_goods->error_validation;
    }
    header('location:index.php');
}

public function actionRemove($id)
{
   $res = $this->model_goods->funcRemove($id);
   if($res) {
     $_SESSION['message_remove'] = "Item was removed...";
   }
   header('location:index.php');
}

public function actionFileSave()
{
	if($this->model_upload->fileValidate($_FILES['userfile'])) {
	   $this->model_upload->funcFileSave($_FILES['userfile']);
    }
    else {
	   $this->message_error = 'Bad format of file!';
    }
    $this->actionStart();
}

public function actionAjaxSearch($search_marka)
{
    $res = $this->model_goods->funcAjaxSearch($search_marka);
    echo json_encode($res);
}

public function actionAjaxSort($sort_way)
{
    $res = $this->model_goods->funcAjaxSort($sort_way);
    echo json_encode($res);
}

public function actionAjaxOrder($id)
{
    if($this->model_api->mailerOrderValidation()) {
       $res['success'] = json_decode($this->model_api->mailerOrder($this->model_goods->funcSelect($id), '', '', ''));
    }
    else {
       $res['error'] = "You can't use this option!";
    }
    echo json_encode($res);
}

public function actionAjaxCurrency()
{
    $res = $this->model_api->mailerCurrency();
    echo $res;
}

}

?>
