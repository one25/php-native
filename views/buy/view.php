<?php if($_SESSION['login']) { ?>
<html>
<head>
<meta http-equiv="Content-Type" content="texthtml; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/mine.js"></script>
</head>
<body>

<div class="container">
   <div class="cart_left margin center">
      <img src="<?php echo $cart[0]['image']; ?>" alt />
      <h4>Marka: <?php echo $cart[0]['marka']; ?></h4>
      <h4>Model: <?php echo $cart[0]['model']; ?></h4>
      <h4>Price: <?php echo $cart[0]['price']; ?></h4>
   </div>
   <div class="cart_right margin">
    <form method="post" action="?page=buy&hook=Send/<?php echo $cart[0]['id']; ?>">
       <div class="row">
         <div class="col-md-4 col-sm-4 col-xs-12">
           <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?php if(isset($_SESSION['name_old']) && $_SESSION['name_old']) echo $_SESSION['name_old']; $_SESSION['name_old'] = ''; ?>" class="input-size" />
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-4 col-sm-4 col-xs-12">
           <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php if(isset($_SESSION['email_old']) && $_SESSION['email_old']) echo $_SESSION['email_old']; $_SESSION['email_old'] = ''; ?>" class="input-size" />
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-4 col-sm-4 col-xs-12">
           <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php if(isset($_SESSION['phone_old']) && $_SESSION['phone_old']) echo $_SESSION['phone_old']; $_SESSION['phone_old'] = ''; ?>" class="input-size" />
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-4 col-sm-4 col-xs-12">
           <div class="form-group">
             <button class="btn btn-success button_buy">Send order</button>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="form-group">
             <label class="red">
             <?php
                if(isset($_SESSION['message_error']) && $_SESSION['message_error']) {
                     $text_error = '';
                     foreach($_SESSION['message_error'] as $error) {
                        $text_error .= $error[0] . '<br>';
                     }
                     echo $text_error;
                     $_SESSION['message_error'] = '';
                }
             ?>
             </label>
           </div>
         </div>
       </div>
    </form>
   </div>
</div>
<?php if(isset($_SESSION['mail_result']) && $_SESSION['mail_result']) { $_SESSION['mail_result'] = ''; ?>
<script>setTimeout("alert('Your message was sended...');", 200);</script>
<?php } ?>
<?php if(isset($_SESSION['mail_error']) && $_SESSION['mail_error']) { $mail_result_error_validate = $_SESSION['mail_error']; $_SESSION['mail_error'] = ''; ?>
<script>setTimeout("alert('<?php echo $mail_result_error_validate; ?>');", 200);</script>
<?php } ?>
</body>
</html>
<?php } else {
   echo '<h3>Access error!</h3>';
} ?>