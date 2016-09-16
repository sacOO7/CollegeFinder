<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link  href="css/style.css" rel="stylesheet">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body >
<div class="background-image"></div>
<?php
 $error="";
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 include "user_valid.php";
}
?>
<div class="content">

<h1 style="align-items: center ; text-align: center ;margin-top: 10% ;color:white ;font-size: 250%">COLLEGE FINDER</h1>
  <form  style="margin-top:5%" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="login" method="post">
    <div>
      <label for="login">Username:</label>
      <input type="text" name="username" id="login" placeholder="Username " style="color: white; text-decoration-color: white ;opacity: 1" required>
    </div>

    <div>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" placeholder="Password" required>
    </div>

    <div class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </div>

    <div class="forgot-password" style="margin-left: 35%"><a href="forgot-password.php">Forgot your password</a></div>
    <div class="panel-footer" style="margin-top: 20px">Not Registered? <a href="Signup.php" style="overflow: visible" >Register here</a>
    </div>
    <br><br><br><span class="error"><?php echo $error;?></span>
  </form>
</div>
  <!--section class="about">
    <p class="about-links">
      <a href="http://www.cssflow.com/snippets/dark-login-form" target="_parent">View Article</a>
      <a href="http://www.cssflow.com/snippets/dark-login-form.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://365psd.com/day/2-234/" target="_blank">Rich McNabb</a>>
  </section-->

</body>
</html>
