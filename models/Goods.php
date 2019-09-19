<?php
namespace GoodsModel;

//require_once 'Valitron/Validator.php';
require_once './vendor/autoload.php';

use Valitron\Validator as V;

class Goods {

public $link_db;
public $row_db;
public $action_patch;
public $error_validation;

public function __construct()
{
   require './config/config.php';
   $link = new \PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_password);
   $query = "set names utf8";
   $pstmt = $link->prepare($query);
   $pstmt->execute();
   $this->link_db=$link;
   $this->action_patch = $action_patch;
   V::langDir(__DIR__.'/validator_lang');
   V::lang('en');
}

public function funcStart()
{
   $query = "select id, marka, model, price, image from computers order by marka asc";
   $pstmt = $this->link_db->prepare($query);
   $pstmt->execute();
   $this->row_db = $pstmt->fetchAll();
}

public function funcInsert($marka, $model, $price, $image)
{
    $query = "insert into computers (marka, model, price, image) values(:marka, :model, :price, :image)";
    $pstmt = $this->link_db->prepare($query);
    $pstmt->bindParam(':marka', $marka, \PDO::PARAM_STR);
    $pstmt->bindParam(':model', $model, \PDO::PARAM_STR);
    $pstmt->bindParam(':price', $price, \PDO::PARAM_INT);
    $pstmt->bindParam(':image', $image, \PDO::PARAM_STR);
    return $pstmt->execute();
}

public function insertValidate($marka, $model, $price, $image)
{
   $v = new V(array('marka' => $marka, 'model' => $model, 'price' => $price));
   $v->rule('required', array('marka', 'model', 'price'))->rule('integer', 'price')->rule('regex', array('marka', 'model'), '/^[a-zA-Z0-9]+$/');
   $result_validate=$v->validate();
   $this->error_validation=$v->errors();
   return $result_validate;
}

public function funcRemove($id)
{
   $query = "delete from computers where id=:id";
   $pstmt = $this->link_db->prepare($query);
   $pstmt->bindParam(':id', $id, \PDO::PARAM_INT);
   return $pstmt->execute();
}

public function funcAjaxSearch($search_marka)
{
    $query="select id, marka, model, price, image from computers where marka like concat('%', :search, '%')";
    $pstmt = $this->link_db->prepare($query);
    $pstmt->bindParam(':search', $search_marka, \PDO::PARAM_STR);
    $pstmt->execute();
    return $pstmt->fetchAll();
}

public function funcAjaxSort($sort_way)
{
   if($sort_way=='asc' || $sort_way=='desc') {
      $query="select id, marka, model, price, image from computers order by price ".$sort_way;
      $pstmt = $this->link_db->prepare($query);
      $pstmt->execute();
      return $pstmt->fetchAll();
   }
}

public function funcLogin($username, $userpass)
{
   $query = "select * from users where login=:login and password=:password";
   $pstmt = $this->link_db->prepare($query);
   $pstmt->bindParam(':login', $username, \PDO::PARAM_STR);
   $pstmt->bindParam(':password', $userpass, \PDO::PARAM_STR);
   $pstmt->execute();
   if($pstmt->fetchAll()) {
      return true;
   }
}

public function funcSelect($id)
{
   $query="select id, marka, model, price, image from computers where id=:id";
   $pstmt = $this->link_db->prepare($query);
   $pstmt->bindParam(':id', $id, \PDO::PARAM_INT);
   $pstmt->execute();
   return $pstmt->fetchAll();
}

}

?>
