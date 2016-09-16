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

    <link  href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="css/style1.css">
</head>
<body>

  <?php
// define variables and set to empty values
$nameErr = $emailErr =$passErr= "";
$name = $email= "";
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
  <div class="background-image"></div>
  <div class="content">
<!--  <h1>COLLEGE FINDER</h1>-->
<!-- Registration form - START -->
<div class="col-sm-4"></div>

  <div class="col-sm-4" style="border-radius=100%; border:2px solid white; align-content: center ;  background-color:black;height:430px;width:350px;margin-top: 70px ;padding-left: 40px">
    <center><b><h1 style="color: white ;font-size:300%">SIGN UP</h1></b></center>
        <form role="form" style="margin-top: 40px" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form" method="post">  <!-- check-->
           <div >
                <!--<label for="Username">Enter Username:</label>-->
                <input style="color: white" type="text" id="Username" name="Username" placeholder="Username" value="<?php echo $name;?>">
                <span style="color: red ;font-size: xx-large">* <?php echo $nameErr;?></span>
           </div>
           <div>
                <!--<label for="InputEmail">Enter Email:</label>-->
                <input type="email" style="color: white" id="InputEmail" name="Email" placeholder="Email" value="<?php echo $email;?>">
               <span style="color: red ;font-size: xx-large">* <?php echo $emailErr;?></span>
           </div>
           <div>
                <!--<label for="password">Enter Password:</label>-->
                <input type="password" id="password" style="color: white" name="Password" placeholder="Password">
                <span style="color: red ;font-size: xx-large">* <?php echo $passErr;?></span>
           </div>
           <div>
                <!--<label for="confirmpassword">Confirm Password:</label>-->
                <input type="password" id="confpassword" name="confPassword" style="color: white" placeholder="Re-enter Password">
                <span style="color: red ;font-size: xx-large">* <?php echo $passErr;?></span>
           </div>
           <div class="container">
                <input type="submit" class="submit" class="btn btn-success" name="submit" id="submit" value="Sign_Up">
           </div>

        </form>
<!-- Registration form - END -->
</div>
</div>
</body>
</html>
