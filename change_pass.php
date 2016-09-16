<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change-Password</title>
    <!--link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script-->
     
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <?php
  
  $passErr="";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $m=new MongoClient();
  $db=$m->project;
  $collection=$db->user_info;

  
  if (empty($_POST["Password"])) {
     $passErr = "Password is required";
  }
  elseif(empty($_POST["confPassword"]))
 {
        $passErr = "Password is required";
 }
 elseif ($_POST['Password']!= $_POST['confPassword'])
 {
     $passErr="Oops! Password did not match! Try again. ";
 }
 else
 {
    session_start();
    $collection->update(array("Username"=>$_SESSION['Username']),array('$set'=>array("Password"=>$_POST['Password']))); 
 }
 if($passErr=="")
 {
  header('Location:Login.php');
 }
 
}

?>
  <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">COLLEGE FINDER</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" id="nav-bar">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li style="margin-left:600px">
                      <a href="#">Account settings</a>
                      <ul>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="change_pass.php">Change Password</a></li>
                        <li><a href="delete.php">Delete Account</a></li>
                      </ul>         
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<!-- Registration form - START -->
<div class="background-image">
   <div class="col-sm-4"></div>
          
  <div class="col-sm-4" class= "content" style="margin-top:130px">
        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form" method="post">  <!-- check-->    
          
           <div>    
                <!--<label for="password">Enter Password:</label>--> 
                <input type="password" id="password" name="Password" placeholder="Password">
                <span class="error">* <?php echo $passErr;?></span>

           </div>
           <div>  
                <!--<label for="confirmpassword">Confirm Password:</label>-->      
                <input type="password" id="confpassword" name="confPassword" placeholder="Re-enter Password">
                <span class="error">* <?php echo $passErr;?></span>
           </div>
              <div>
                <input type="submit" name="submit" id="search" value="Submit" style="margin-left:80px;margin-bottom:20px;" >
               </div>
           
        </form>
<!-- Registration form - END -->

     </div> 
  </div>
</div>

</body>
</html>
