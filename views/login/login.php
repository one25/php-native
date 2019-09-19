<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style_login.css">
</head>
<body>

<div class="login_form">
<h2>Login Form</h2>

<form method="post" action="<?php echo $this->model_goods->action_patch; ?>">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="userpass" required>
    <span class="red"><?php if(isset($login_error) && $login_error) echo $login_error; else echo "&nbsp;"; ?></span>
    <button type="submit" name="hook" value="Login">Login</button>
  </div>
</form>
</div>

</body>
</html>
