<?php
namespace UploadModel;

class Upload {

public $file_patch;

public function __construct()
{
   require './config/config.php';
   $this->file_patch=$file_patch;
}

public function funcFileSave($files)
{
   copy($files['tmp_name'], $this->file_patch.$files['name']);
}

public function fileValidate($file)
{
   $img = getimagesize($file['tmp_name']);
   if($img['mime'] == 'image/jpeg' || $img['mime'] == 'image/png') {
      return true;
   }
}

}

?>
