<?php if(isset($_SESSION['login'])) { ?>
<html>
<head>
<meta http-equiv="Content-Type" content="texthtml; charset=utf-8" />
<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/mine.js"></script>
</head>
<body>

<div class="container">
    <div class="form_insert">
        <h3 class="green">Inserting of new product</h3>
        <div class="image_insert">
            <?php
            if(isset($_FILES['userfile']) && !$message_error) {
            ?>
           <img src="img/<?php echo $_FILES['userfile']['name']; ?>" alt />
            <?php
           } else {
            ?>
            <img src="img/nophoto.jpg" alt />
            <?php
           }
            ?>
            <br>
            <form method="post" action="<?php echo $this->model_goods->action_patch; ?>" enctype="multipart/form-data">
            <input type="file" name="userfile" class="upload_field" />
            <input type="submit" name="hook" value="FileSave" class="upload_submit" />
            <button type="button" class="upload_button_decoration">select and write</button>
            </form>
        </div>
        <div class="fields_insert">
            <form name="forminsert" method="post" action="<?php echo $this->model_goods->action_patch; ?>">
            Marka <input type="text" name="textinsert_marka" class="textinsert" value="<?php if(isset($_SESSION['marka_old']) && $_SESSION['marka_old']) echo $_SESSION['marka_old']; $_SESSION['marka_old'] = ''; ?>" /><br><br>
            Model <input type="text" name="textinsert_model" class="textinsert" value="<?php if(isset($_SESSION['model_old']) && $_SESSION['model_old']) echo $_SESSION['model_old']; $_SESSION['model_old'] = ''; ?>" /><br><br>
            Price &nbsp;<input type="text" name="textinsert_price" class="textinsert" value="<?php if(isset($_SESSION['price_old']) && $_SESSION['model_old']) echo $_SESSION['price_old']; $_SESSION['price_old'] = ''; ?>" /><br><br><br>
            <?php
            if(isset($_FILES['userfile'])) {
            ?>
            <input type="hidden" name="textinsert_image" value="img/<?php echo $_FILES['userfile']['name']; ?>" class="textinsert" />
            <?php
            } else {
            ?>
            <input type="hidden" name="textinsert_image" value="img/nophoto.jpg" class="textinsert" />
            <?php
            }
            ?>
            <span class="red">
            <?php
               if(isset($_SESSION['message_error']) && $_SESSION['message_error']) {$message_error = $_SESSION['message_error']; $_SESSION['message_error'] = '';}
               if($message_error) {
                  if(is_array($message_error)) {
                     $text_error = '';
                     foreach($message_error as $error) {
                        $text_error .= $error[0] . '<br>';
                     }
                     echo $text_error;
                  }
                  else {
                     echo $message_error;
                  }
               } else echo "&nbsp;"
            ?>
            </span>
            <hr>
            <input type="submit" name="hook" value="Insert" class="submitinsert" />
            </form>
        </div>
    </div>
    <div class="form_select">
        <div class="currency"> <!-- !!!1 -->
           <div class="currency_title">USD:</div><div class="currency_usd_value">&nbsp;</div>
           <div class="currency_title">EUR:</div><div class="currency_eur_value">&nbsp;</div>
        </div>
        <div class="clear"></div>
        <div class="form_search">
            <h3 class="blue">Searching by marka of product</h3>
            <form name="formsearch" method="post" action="<?php echo $this->model_goods->action_patch; ?>">
            Marka <input type="text" name="textsearch_marka" class="textsearch" />
            <input type="button" value="search by marka" class="buttonsearch" />
            </form>
        </div>
        <hr>
        <div class="goods">
            <form name="formremove" method="post" action="<?php echo $this->model_goods->action_patch; ?>">
            <table width="100%">
                <tbody>
                <tr><th class="lightgreen">order</th><th>Marka</th><th>Model</th>
                <th style="font-weight:bold; background-color:white;">
                <table>
                <tr>
                <td rowspan="2" class="td_rowspan_price">Price</td>
                <td class="td_rowspan_img"><img src="img/top.jpg" name="sort_top" class="img_very_little"></td>
                </tr>
                <tr>
                <td class="td_rowspan_img"><img src="img/bottom.jpg" name="sort_bottom" class="img_very_little"></td>
                </tr>
                </table>
                </th><th>Image</th><th class="gold">remove</th></tr>
                </tbody>
                <tbody class="tbody">
                <?php
                if(is_array($arr_goods)) {
                foreach($arr_goods as $arr_goods_value) {
                ?>
                <tr>
                <?php
                echo '<td class="center"><button type="button" class="order" value="'.$arr_goods_value['id'].'">order</button></td><td><a href="?page=cart&hook=Cart/'.$arr_goods_value['id'].'">'.$arr_goods_value['marka'].'</a></td><td>'.$arr_goods_value['model'].'</td><td>'.$arr_goods_value['price'].'</td><td><img src="'.$arr_goods_value['image'].'" alt /></td><td class="center"><button name="hook" value="Remove/'.$arr_goods_value['id'].'">remove</button></td>';
                ?>
                </tr>
                <?php
                }
                }
                ?>
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>
<?php
if(isset($_SESSION['message_insert']) && $_SESSION['message_insert']) { $message_insert = $_SESSION['message_insert']; $_SESSION['message_insert'] = ''; ?>
<script>
setTimeout('alert("<?php echo $message_insert; ?>")', 200);
</script>
<?php } ?>
<?php
if(isset($_SESSION['message_remove']) && $_SESSION['message_remove']) { $message_remove = $_SESSION['message_remove']; $_SESSION['message_remove'] = ''; ?>
<script>
setTimeout('alert("<?php echo $message_remove; ?>")', 200);
</script>';
<?php } ?>
</body>
</html>
<?php } else {
   echo '<h3>Access error!</h3>';
} ?>