<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot-Password</title>
    <!--link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script-->
     
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <?php
  $auth_err="";
  $password="";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $m=new MongoClient();
  $db=$m->project;
  $collection=$db->user_info;
   
  $cursor=$collection->findOne(array("Username"=>$_POST["Username"],"security_qs"=>$_POST["security"])); 
  
  if(isset($cursor))
  {
    $password=$cursor['Password'];
  }
  else
  {
  	$auth_err="Sorry!Your inputs did not match.";
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
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">ContactUs</a>
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
           <span class="error" style="font-size:18px"><?php echo $auth_err;?></span>
           <div>
                <!--<label for="Username">Enter Username:</label>-->                                          
                <input type="text" id="Username" name="Username" placeholder="Username">
                
           </div>     
                <!--<label for="confirmpassword">Confirm Password:</label>-->      
                <input type="text"  name="security" placeholder="Enter your security question"> 
         
           <div>
                <label for="password" style="color:Blue;rgba:(0,0,0,1);font-size:20px">Your password is:</label>
                <input type="text" id="password" value"">
           </div>
              <div>
                <input type="submit" name="submit" id="search" value="Submit" style="margin-left:80px;margin-bottom:20px;" >
               </div>
               
           <div class="panel-footer" style="margin-left:20px;"><a href="Login.php" class="">Re-Login Here?</a>

           <script type="text/javascript">
           var password='<?php echo $password;?>';
           document.getElementById('password').value=password;
           </script>
           
        </form>
<!-- Registration form - END -->

     </div> 
  </div>
</div>

</body>
</html>
