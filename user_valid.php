<?php

$m=new MongoClient();
$db=$m->project;
$collection=$db->user_info;

session_start();
$_SESSION["Username"]=$_POST["username"];

$cursor=$collection->findOne(array("Username" =>$_POST["username"] ,"Password"=>$_POST["password"]) );

if($cursor)
{
	header("Location: http://localhost/Project5/Search.php");
}	
else 
{	
	$error="Sorry! Username or Password did not match";
	
}
?>