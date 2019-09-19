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
   <div class="cart_left">
      <img src="<?php echo $cart[0]['image']; ?>" class="cart_img" alt />
   </div>
   <div class="cart_right">
      <h3>Marka: <?php echo $cart[0]['marka']; ?></h3>
      <h3>Model: <?php echo $cart[0]['model']; ?></h3>
      <h3>Price: <?php echo $cart[0]['price']; ?></h3>
      <a class="btn btn-primary button_buy" href="?page=buy&hook=Buy/<?php echo $cart[0]['id']; ?>">Buy</a>
   </div>
</div>

</body>
</html>
<?php } else {
   echo '<h3>Access error!</h3>';
} ?>