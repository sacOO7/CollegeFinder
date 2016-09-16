<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Sign-Up Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script-->
     
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <?php
// define variables and set to empty values
$nameErr = $emailErr =$passErr= "";
$name = $email=$securityerr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $password=$_POST["Password"];
   if (empty($_POST["Username"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["Username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed";
     }
   }
  
   if (empty($_POST["Email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["Email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format";
     }
   }
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
 if(($_POST["Security"])=="Select Security Question")
 {
  $securityerr="Please select a security question";
 }
//insert into database after validations
if($nameErr==""&&$emailErr==""&&$passErr=="")
{
  include_once"sign-connect.php";
}
}


function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
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
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <h1>COLLEGE FINDER</h1>
    
<!-- Registration form - START -->
<div class="background-image">
   <div class="col-sm-4"></div>
          
  <div class="col-sm-4" class= "content">
    <h1 style="color:#00a1d2;margin-left:85px"><b><mark>SIGN  UP</mark></b></h1>
        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form" method="post">  <!-- check-->    
           <div>
                <!--<label for="Username">Enter Username:</label>-->                                          
                <input type="text" id="Username" name="Username" placeholder="Username" value="<?php echo $name;?>">
                <span class="error">* <?php echo $nameErr;?></span>
           </div>     
           <div>     
                <!--<label for="InputEmail">Enter Email:</label>-->                
                <input type="email" id="InputEmail" name="Email" placeholder="Email" value="<?php echo $email;?>">
               <span class="error">* <?php echo $emailErr;?></span>
           </div>
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
                <select name="security" id="security" >
                  <option value="">Select Security Question</option>
                  <option value="What is your name?">What is your name?</option>
                  <option value="Which is your favourite place?">Which is your favourite place?</option>
                  <option value="What is your father name?">What is your father name?</option>
                  <option value="Who is your role model?">Who is your role model?</option>
                </select>   
                <span class="error">* <?php echo $securityerr;?></span>
           </div>  
           <div>
                <input type="submit" class="submit" name="submit" id="submit" value="Sign_Up">
           </div>

           
        </form>
<!-- Registration form - END -->

     </div> 
  </div>
</div>

</body>
</html>
