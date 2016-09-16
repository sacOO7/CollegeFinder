<?php

$m=new MongoClient();
$db=$m->project;
$collection=$db->user_info;

$cursor=$collection->findOne(array("Username" =>$_POST["username"] ,"Password"=>$_POST["password"]) );

if($cursor)
{
	header("Location: http://localhost:1234/Search.php");
}	
else 
{	
	$error="Sorry! Username or Password did not match";
	
}
?>